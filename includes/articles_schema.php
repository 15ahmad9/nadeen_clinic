<?php

/**
 * Makes the articles feature work with both fresh and older databases.
 * Old title/content values are kept and copied into the Arabic/English fields.
 */
function ensure_articles_schema(PDO $pdo): void
{
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS articles (
            id INT(11) NOT NULL AUTO_INCREMENT,
            title_ar VARCHAR(255) DEFAULT NULL,
            title_en VARCHAR(255) DEFAULT NULL,
            content_ar LONGTEXT DEFAULT NULL,
            content_en LONGTEXT DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
    );

    $columns = [];
    foreach ($pdo->query("SHOW COLUMNS FROM articles")->fetchAll() as $column) {
        $columns[$column['Field']] = $column;
    }

    $requiredColumns = [
        'title_ar'   => "ALTER TABLE articles ADD COLUMN title_ar VARCHAR(255) DEFAULT NULL AFTER id",
        'title_en'   => "ALTER TABLE articles ADD COLUMN title_en VARCHAR(255) DEFAULT NULL AFTER title_ar",
        'content_ar' => "ALTER TABLE articles ADD COLUMN content_ar LONGTEXT DEFAULT NULL AFTER title_en",
        'content_en' => "ALTER TABLE articles ADD COLUMN content_en LONGTEXT DEFAULT NULL AFTER content_ar",
        'image'      => "ALTER TABLE articles ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER content_en",
        'created_at' => "ALTER TABLE articles ADD COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER image",
    ];

    foreach ($requiredColumns as $name => $sql) {
        if (!isset($columns[$name])) {
            $pdo->exec($sql);
            $columns[$name] = ['Field' => $name, 'Null' => 'YES'];
        }
    }

    // Preserve articles created by the previous one-language version.
    // The legacy fields are made nullable so new bilingual inserts keep working.
    if (isset($columns['title'])) {
        if (($columns['title']['Null'] ?? 'NO') !== 'YES') {
            $pdo->exec("ALTER TABLE articles MODIFY COLUMN title VARCHAR(255) DEFAULT NULL");
        }
        $pdo->exec(
            "UPDATE articles
             SET title_ar = COALESCE(NULLIF(title_ar, ''), title),
                 title_en = COALESCE(NULLIF(title_en, ''), title)
             WHERE title IS NOT NULL AND title <> ''
               AND (title_ar IS NULL OR title_ar = '' OR title_en IS NULL OR title_en = '')"
        );
    }

    if (isset($columns['content'])) {
        if (($columns['content']['Null'] ?? 'NO') !== 'YES') {
            $pdo->exec("ALTER TABLE articles MODIFY COLUMN content LONGTEXT DEFAULT NULL");
        }
        $pdo->exec(
            "UPDATE articles
             SET content_ar = COALESCE(NULLIF(content_ar, ''), content),
                 content_en = COALESCE(NULLIF(content_en, ''), content)
             WHERE content IS NOT NULL AND content <> ''
               AND (content_ar IS NULL OR content_ar = '' OR content_en IS NULL OR content_en = '')"
        );
    }
}

function article_value(array $article, string $field, string $language): string
{
    $primary = $field . '_' . $language;
    $fallback = $field . '_' . ($language === 'ar' ? 'en' : 'ar');

    foreach ([$primary, $fallback, $field] as $key) {
        if (isset($article[$key]) && trim((string)$article[$key]) !== '') {
            return (string)$article[$key];
        }
    }

    return '';
}
