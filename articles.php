<?php
require "includes/language.php";
require "config/database.php";
require_once "includes/articles_schema.php";

ensure_articles_schema($pdo);
$articles = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC, id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(t('lang_code')) ?>" dir="<?= htmlspecialchars(t('dir')) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(t('articles')) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .articles-page {
            min-height: 100vh;
            background: linear-gradient(180deg, #f8fafc 0%, #eef7f5 100%);
            padding: 50px 5% 90px
        }

        .articles-header {
            max-width: 760px;
            margin: 0 auto 45px;
            text-align: center
        }

        .articles-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(74, 173, 159, .12);
            color: #406763;
            padding: 8px 18px;
            border-radius: 999px;
            font-weight: 700;
            margin-bottom: 14px
        }

        .articles-header h1 {
            font-size: clamp(2rem, 5vw, 3.6rem);
            color: #12394d;
            margin: 0 0 15px
        }

        .articles-header p {
            color: #60747e;
            font-size: 1.05rem;
            line-height: 1.9;
            margin: 0
        }

        .articles-grid {
            max-width: 1200px;
            margin: auto;
            /* display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 28px */
        }

        .article-card {
            background: #fff;
            margin-bottom: 25px;
            border: 1px solid rgba(18, 57, 77, .08);
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(18, 57, 77, .09);
            transition: transform .3s ease, box-shadow .3s ease
        }

        .article-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 24px 60px rgba(18, 57, 77, .14)
        }

        .article-media {
            height: 245px;
            background: linear-gradient(135deg, #12394d, #4aad9f);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .article-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .article-card:hover .article-media img {
            transform: scale(1.04)
        }

        .article-placeholder {
            font-size: 72px;
            font-weight: 800;
            color: rgba(255, 255, 255, .85)
        }

        .article-content {
            padding: 28px
        }

        .article-date {
            display: block;
            color: #4aad9f;
            font-size: .88rem;
            font-weight: 700;
            margin-bottom: 12px
        }

        .article-content h2 {
            color: #12394d;
            font-size: 1.45rem;
            line-height: 1.45;
            margin: 0 0 14px
        }

        .article-content p {
            line-height: 1.95;
            color: #536b76;
            margin: 0;
            white-space: pre-line
        }

        .articles-empty {
            max-width: 700px;
            margin: 20px auto;
            background: #fff;
            padding: 55px 25px;
            border-radius: 26px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(18, 57, 77, .08)
        }

        .articles-empty h2 {
            color: #12394d;
            margin: 0 0 10px
        }

        .articles-empty p {
            color: #6d7f87;
            margin: 0
        }

        html[dir="rtl"] .article-content {
            text-align: right
        }

        html[dir="ltr"] .article-content {
            text-align: left
        }

        @media(max-width:700px) {
            .articles-page {
                padding: 110px 18px 65px
            }

            .articles-grid {
                grid-template-columns: 1fr;
                gap: 20px
            }

            .article-media {
                height: 210px
            }

            .article-content {
                padding: 22px
            }

            .articles-header {
                margin-bottom: 30px
            }
        }
    </style>
</head>

<body>
    <?php include "includes/navbar.php"; ?>
    <main class="articles-page">
        <header class="articles-header">
            <span class="articles-kicker"><?= htmlspecialchars(t('clinic_articles')) ?></span>
            <h1><?= htmlspecialchars(t('articles')) ?></h1>
            <p><?= htmlspecialchars(t('articles_intro')) ?></p>
        </header>

        <?php if (!$articles): ?>
            <section class="articles-empty">
                <h2><?= htmlspecialchars(t('no_articles_available')) ?></h2>
                <p><?= htmlspecialchars(t('check_back_for_articles')) ?></p>
            </section>
        <?php else: ?>
            <section class="articles-grid">
                <?php foreach ($articles as $article):
                    $title = article_value($article, 'title', $lang);
                    $content = article_value($article, 'content', $lang);
                    ?>
                    <article class="article-card">
                        <div class="article-media">
                            <?php if (!empty($article['image'])): ?>
                                <img src="uploads/articles/<?= rawurlencode(basename($article['image'])) ?>"
                                    alt="<?= htmlspecialchars($title) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="article-placeholder">N</div>
                            <?php endif; ?>
                        </div>
                        <div class="article-content">
                            <?php if (!empty($article['created_at'])): ?>
                                <time class="article-date" datetime="<?= htmlspecialchars($article['created_at']) ?>">
                                    <?= htmlspecialchars(date('Y-m-d', strtotime($article['created_at']))) ?>
                                </time>
                            <?php endif; ?>
                            <h2><?= htmlspecialchars($title) ?></h2>
                            <p><?= nl2br(htmlspecialchars($content)) ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>