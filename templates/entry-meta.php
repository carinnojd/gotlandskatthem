<time class="updated" id ="time" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
<p class="byline author vcard" id="author"><?= __('Skriven av', 'sage'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" id="authorID" rel="author" class="fn"><?= get_the_author(); ?></a></p>
