<?php
require "auth.php";
require "../config/database.php";
require_once "../includes/language.php";
require_once "../includes/articles_schema.php";

ensure_articles_schema($pdo);

if (empty($_SESSION['articles_csrf'])) {
    $_SESSION['articles_csrf'] = bin2hex(random_bytes(32));
}

$success = $_SESSION['articles_success'] ?? '';
$error = $_SESSION['articles_error'] ?? '';
unset($_SESSION['articles_success'], $_SESSION['articles_error']);

function redirect_articles(): void
{
    header('Location: articles.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['articles_csrf'], $token)) {
        $_SESSION['articles_error'] = t('invalid_request');
        redirect_articles();
    }

    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $titleAr = trim($_POST['title_ar'] ?? '');
        $titleEn = trim($_POST['title_en'] ?? '');
        $contentAr = trim($_POST['content_ar'] ?? '');
        $contentEn = trim($_POST['content_en'] ?? '');

        if ($titleAr === '' || $titleEn === '' || $contentAr === '' || $contentEn === '') {
            $_SESSION['articles_error'] = t('all_article_fields_required');
            redirect_articles();
        }

        $imageName = null;
        $image = $_FILES['image'] ?? null;

        if ($image && $image['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($image['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['articles_error'] = t('image_upload_failed');
                redirect_articles();
            }

            if ($image['size'] > 5 * 1024 * 1024) {
                $_SESSION['articles_error'] = t('image_too_large');
                redirect_articles();
            }

            if (class_exists('finfo')) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($image['tmp_name']);
            } else {
                $mime = function_exists('mime_content_type')
                    ? mime_content_type($image['tmp_name'])
                    : '';
            }
            $allowed = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
            ];

            if (!isset($allowed[$mime])) {
                $_SESSION['articles_error'] = t('invalid_image_type');
                redirect_articles();
            }

            $uploadDir = __DIR__ . '/../uploads/articles/';
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true) && !is_dir($uploadDir)) {
                $_SESSION['articles_error'] = t('image_upload_failed');
                redirect_articles();
            }

            $imageName = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
            if (!move_uploaded_file($image['tmp_name'], $uploadDir . $imageName)) {
                $_SESSION['articles_error'] = t('image_upload_failed');
                redirect_articles();
            }
        }

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO articles (title_ar, title_en, content_ar, content_en, image)
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([$titleAr, $titleEn, $contentAr, $contentEn, $imageName]);
            $_SESSION['articles_success'] = t('article_added_successfully');
        } catch (Throwable $e) {
            if ($imageName) {
                @unlink(__DIR__ . '/../uploads/articles/' . $imageName);
            }
            $_SESSION['articles_error'] = t('article_save_failed');
        }

        redirect_articles();
    }

    if ($action === 'delete') {
        $articleId = filter_input(INPUT_POST, 'article_id', FILTER_VALIDATE_INT);

        if (!$articleId) {
            $_SESSION['articles_error'] = t('invalid_request');
            redirect_articles();
        }

        $stmt = $pdo->prepare("SELECT image FROM articles WHERE id = ?");
        $stmt->execute([$articleId]);
        $article = $stmt->fetch();

        if (!$article) {
            $_SESSION['articles_error'] = t('article_not_found');
            redirect_articles();
        }

        $delete = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        $delete->execute([$articleId]);

        if (!empty($article['image'])) {
            $imagePath = __DIR__ . '/../uploads/articles/' . basename($article['image']);
            if (is_file($imagePath)) {
                @unlink($imagePath);
            }
        }

        $_SESSION['articles_success'] = t('article_deleted_successfully');
        redirect_articles();
    }
}

$articles = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC, id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(t('lang_code')) ?>" dir="<?= htmlspecialchars(t('dir')) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="admin.css">
    <title><?= htmlspecialchars(t('articles_management')) ?></title>
</head>
<body>
<?php include "includes/header.php"; ?>
<?php include "includes/sidebar.php"; ?>

<main class="main articles-admin-page">
    <section class="admin-page-heading">
        <div>
            <span class="admin-eyebrow"><?= htmlspecialchars(t('content_management')) ?></span>
            <h1><?= htmlspecialchars(t('articles_management')) ?></h1>
            <p><?= htmlspecialchars(t('articles_management_description')) ?></p>
        </div>
        <div class="article-counter">
            <strong><?= count($articles) ?></strong>
            <span><?= htmlspecialchars(t('published_articles')) ?></span>
        </div>
    </section>

    <?php if ($success): ?>
        <div class="admin-alert admin-alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="admin-alert admin-alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <section class="article-form-panel">
        <div class="panel-title-row">
            <div>
                <h2><?= htmlspecialchars(t('add_new_article')) ?></h2>
                <p><?= htmlspecialchars(t('fill_both_languages')) ?></p>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data" class="article-admin-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['articles_csrf']) ?>">
            <input type="hidden" name="action" value="add">

            <div class="bilingual-form-grid">
                <div class="language-form-card" dir="rtl">
                    <div class="language-card-label"><span>AR</span> العربية</div>
                    <label for="title_ar"><?= htmlspecialchars(t('article_title_ar')) ?></label>
                    <input id="title_ar" name="title_ar" type="text" maxlength="255" required
                           placeholder="<?= htmlspecialchars(t('article_title_ar_placeholder')) ?>">

                    <label for="content_ar"><?= htmlspecialchars(t('article_content_ar')) ?></label>
                    <textarea id="content_ar" name="content_ar" rows="10" required
                              placeholder="<?= htmlspecialchars(t('article_content_ar_placeholder')) ?>"></textarea>
                </div>

                <div class="language-form-card" dir="ltr">
                    <div class="language-card-label"><span>EN</span> English</div>
                    <label for="title_en"><?= htmlspecialchars(t('article_title_en')) ?></label>
                    <input id="title_en" name="title_en" type="text" maxlength="255" required
                           placeholder="<?= htmlspecialchars(t('article_title_en_placeholder')) ?>">

                    <label for="content_en"><?= htmlspecialchars(t('article_content_en')) ?></label>
                    <textarea id="content_en" name="content_en" rows="10" required
                              placeholder="<?= htmlspecialchars(t('article_content_en_placeholder')) ?>"></textarea>
                </div>
            </div>

            <div class="article-image-field">
                <label for="image"><?= htmlspecialchars(t('article_image')) ?></label>
                <div class="file-input-box">
                    <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp">
                    <span><?= htmlspecialchars(t('article_image_hint')) ?></span>
                </div>
            </div>

            <button class="btn article-submit-btn" type="submit">
                <span>+</span> <?= htmlspecialchars(t('publish_article')) ?>
            </button>
        </form>
    </section>

    <section class="articles-list-section">
        <div class="panel-title-row">
            <div>
                <h2><?= htmlspecialchars(t('existing_articles')) ?></h2>
                <p><?= htmlspecialchars(t('manage_existing_articles')) ?></p>
            </div>
        </div>

        <?php if (!$articles): ?>
            <div class="empty-admin-state">
                <div class="empty-state-icon">✦</div>
                <h3><?= htmlspecialchars(t('no_articles_yet')) ?></h3>
                <p><?= htmlspecialchars(t('no_articles_description')) ?></p>
            </div>
        <?php else: ?>
            <div class="admin-articles-grid">
                <?php foreach ($articles as $article): ?>
                    <article class="admin-article-card">
                        <div class="admin-article-image">
                            <?php if (!empty($article['image'])): ?>
                                <img src="../uploads/articles/<?= rawurlencode(basename($article['image'])) ?>"
                                     alt="<?= htmlspecialchars(article_value($article, 'title', 'en')) ?>">
                            <?php else: ?>
                                <div class="article-image-placeholder">N</div>
                            <?php endif; ?>
                        </div>

                        <div class="admin-article-body">
                            <div class="article-language-preview" dir="rtl">
                                <span class="language-pill">AR</span>
                                <h3><?= htmlspecialchars(article_value($article, 'title', 'ar')) ?></h3>
                                <p><?= htmlspecialchars(mb_strimwidth(article_value($article, 'content', 'ar'), 0, 180, '…', 'UTF-8')) ?></p>
                            </div>

                            <div class="article-language-preview" dir="ltr">
                                <span class="language-pill">EN</span>
                                <h3><?= htmlspecialchars(article_value($article, 'title', 'en')) ?></h3>
                                <p><?= htmlspecialchars(mb_strimwidth(article_value($article, 'content', 'en'), 0, 180, '…', 'UTF-8')) ?></p>
                            </div>

                            <div class="admin-article-footer">
                                <time datetime="<?= htmlspecialchars($article['created_at'] ?? '') ?>">
                                    <?= !empty($article['created_at']) ? htmlspecialchars(date('Y-m-d', strtotime($article['created_at']))) : '' ?>
                                </time>

                                <form method="post" class="delete-article-form"
                                      onsubmit="return confirm('<?= htmlspecialchars(t('confirm_delete_article'), ENT_QUOTES) ?>');">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['articles_csrf']) ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="article_id" value="<?= (int)$article['id'] ?>">
                                    <button type="submit" class="delete-article-btn">
                                        <?= htmlspecialchars(t('delete_article')) ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
