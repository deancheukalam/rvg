<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>

<p>
    <?php _e('Enter your password to view comments.','eGamer'); ?>
</p>
<?php return; endif; ?>
<h2 id="comments" style="margin-top: 15px;">
    <?php comments_number(__('Geen reacties','eGamer'), __('E&eacute;n reactie','eGamer'), __('% reacties','eGamer')); ?>
    <?php if ( comments_open() ) : ?>
    <a href="#postcomment" title="<?php _e('Laat een reactie achter','eGamer'); ?>">&raquo;</a>
    <?php endif; ?>
</h2>
<?php if ($comments) : ?>
<ol class="commentlist">
    <?php foreach ($comments as $comment) : ?>
    <li>
        <div>
            <div class="comment-author vcard"> <?php echo get_avatar( $comment, $size = '60' );  ?> <cite class="fn">
                <?php comment_author_link() ?>
                </cite> <span class="says"><?php _e('zegt:','eGamer'); ?></span> </div>
            <div class="comment-meta commentmetadata"> <a href="#comment-<?php comment_ID() ?>" title="">
                <?php comment_date('F jS, Y') ?>
                </a></div>
            <?php comment_text() ?>
        </div>
    </li>
    <?php endforeach; ?>
</ol>
<div style="clear: both;"></div>
<?php else : // If there are no comments yet ?>
<p>
    <?php _e('Er zijn nog geen reacties.','eGamer'); ?>
</p>
<?php endif; ?>
<p>
    <?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.','eGamer')); ?>
    <?php if ( pings_open() ) : ?>
    <a href="<?php trackback_url() ?>" rel="trackback">
    <?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>','eGamer'); ?>
    </a>
    <?php endif; ?>
</p>
<?php if ( comments_open() ) : ?>
<h2 id="postcomment">
    <?php _e('Laat een reactie achter','eGamer'); ?>
</h2>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('U moet zijn <a href="%s">ingelogd</a> om een reactie te plaatsen.','eGamer')), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <?php if ( $user_ID ) : ?>
    <p><?php printf(__('Ingelogd als %s.','eGamer'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Uitloggen','eGamer'); ?>">
        <?php _e('Log uit &raquo;','eGamer'); ?>
        </a></p>
    <?php else : ?>
    <p>
        <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
        <label for="author"><small>
            <?php _e('Naam','eGamer'); ?>
            <?php if ($req) _e('(verplicht)','eGamer'); ?>
            </small></label>
    </p>
    <p>
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
        <label for="email"><small>
            <?php _e('Mail (wordt niet weergegeven)','eGamer') ?>
            <?php if ($req) _e('(verp;icht)','eGamer'); ?>
            </small></label>
    </p>
    <p>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
        <label for="url"><small>
            <?php _e('Website','eGamer'); ?>
            </small></label>
    </p>
    <?php endif; ?>
    <!--<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s','eGamer'), allowed_tags()); ?></small></p>-->
    <p>
        <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
    </p>
    <p>
        <input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo attribute_escape(__('Plaatsen','eGamer')); ?>" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
    </p>
    <?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // If registration required and not logged in ?>
<?php else : // Comments are closed ?>
<p>
    <?php _e('Sorry, het is nu niet mogelijk een reactie te plaatsen.','eGamer'); ?>
</p>
<?php endif; ?>
