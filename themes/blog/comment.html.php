<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<?php foreach($comments_list as $c): ?>
<div class="media comment-list">
    <div class="media-body comment-body">
        <h5>
            <a href="<?php if(empty($c->reply)) echo $c->url; ?>"><?php if(empty($c->reply)) echo $c->name; ?></a> <small><?php if(empty($c->reply)) echo format_date($c->time, true); ?></small>
        </h5>
        <?php if(empty($c->reply)) echo trim($c->body); ?>
        <?php foreach(get_comment_reply($c->comment, $c->num) as $r): ?>
        <?php if(!empty($r)): ?>
        <div class="media comment-reply-list" style="padding-left: 20px;">
            <div class="media-body comment-reply-body">
                <h5>
                    <a href="<?php echo $r->url; ?>"><?php echo $r->name; ?></a> <small><?php echo format_date($r->time, true); ?></small>
                </h5>
                <?php echo trim($r->body); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>
<?php if(!empty($error)): ?>
<div class="alert alert-danger comment-alert">
    <?php echo $error; ?>
</div>
<?php endif; ?>
<form method="POST">
    <div class="form-group comment-div">
        <label for="nameComment">Name</label> <span class="required">*</span>
        <input type="text" name="comment_name" class="form-control comment-name <?php if (isset($cName)) {if (empty($cName)) {echo 'is-invalid';}} ?>" id="nameComment1" value="<?php if (isset($cName)) {echo $cName;} ?>" aria-describedby="name" placeholder="Enter your name">
    </div>
    <div class="form-group comment-div">
        <label for="emailComment">Email</label> <span class="required">*</span>
        <input type="email" name="comment_email" class="form-control comment-email <?php if (isset($cEmail)) {if (empty($cEmail)) {echo 'is-invalid';}} ?>" id="emailComment1" value="<?php if (isset($cEmail)) {echo $cEmail;} ?>" placeholder="Enter your email">
    </div>
    <div class="form-group comment-div">
        <label for="urlComment">Website</label>
        <input type="text" name="comment_url" class="form-control comment-url <?php if (isset($cUrl)) {if (empty($cUrl)) {echo 'is-invalid';}} ?>" id="urlComment1" value="<?php if (isset($cUrl)) {echo $cUrl;} ?>" placeholder="Enter your website (e.g. http://yourdomain.com) (optional)">
    </div>
    <div class="form-group comment-div">
        <label for="comment">Comment</label> <span class="required">*</span>
        <textarea name="comment_content" class="form-control comment-content <?php if (isset($cContent)) {if (empty($cContent)) {echo 'is-invalid';}} ?>" id="contentComment" rows="3"><?php if (isset($cContent)) {echo $cContent;} ?></textarea>
    </div>
    <div class="form-group comment-div">
        <input type="hidden" name="comment_reply" class="form-control comment-reply" id="replyComment1" value="<?php if (isset($cReply)) {echo $cReply;} ?>">
        <input type="hidden" name="csrf_token" class="form-control comment-csrf" id="csrfComment1" value="<?php echo get_csrf() ?>">
        <?php if (config('google.reCaptcha') === 'true'): ?>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <div class="g-recaptcha" data-sitekey="<?php echo config("google.reCaptcha.public"); ?>"></div>
            <br/>
        <?php endif; ?>
        <button type="submit" name="submit" class="btn btn-primary comment-submit">Submit Comment</button>
    </div>
</form>