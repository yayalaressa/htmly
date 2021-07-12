<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<h2 class="post-index"><?php echo $heading ?></h2>
<br><br>
<?php if (!empty($comments_all)) { ?>
    <table id="htmly-table" class="table post-list" style="width:100%">
    <thead>
    <tr class="head">
        <th><?php echo i18n('Post');?></th>
        <th><?php echo i18n('Name');?></th>
        <th><?php echo i18n('Email');?></th>
        <th><?php echo i18n('Url');?></th>
        <th><?php echo i18n('Body');?></th>
        <th><?php echo i18n('Operations');?></th>
    </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        $len = count($comments_all); ?>
        <?php foreach ($comments_all as $p): ?>
            <?php
            if ($i == 0) {
                $class = 'item first';
            } elseif ($i == $len - 1) {
                $class = 'item last';
            } else {
                $class = 'item';
            }
            $i++;
            ?>
            <tr class="<?php echo $class ?>">
                <td><a target="_blank" href="<?php echo $p->url ?>"><?php echo $p->name ?></a></td>
                <td><?php echo format_date($p->time, true) ?></td>
                <td><a target="_blank" href="<?php echo $p->url ?>"><?php echo $p->name ?></a></td>
                <td><a href="mailto:<?php echo $p->email; ?>"><?php echo $p->email;?></a></td>
                <td><?php echo $p->body ?></td>
                <td><a class="btn btn-primary btn-sm" href="<?php echo $p->url ?>/edit?destination=admin/posts"><?php echo i18n('Edit');?></a> <a
                        class="btn btn-danger btn-sm" href="<?php echo $p->url ?>/delete?destination=admin/posts"><?php echo i18n('Delete');?></a></td>
            </tr>
            <?php foreach(get_comment_reply($p->comment, $p->num) as $r): ?>
            <?php
            if ($i == 0) {
                $class = 'item first';
            } elseif ($i == $len - 1) {
                $class = 'item last';
            } else {
                $class = 'item';
            }
            $i++;
            ?>
            <tr class="<?php echo $class ?>">
                <td> <span style="margin-left:30px;">&raquo; <a target="_blank" href="<?php echo $r->url ?>"><?php echo $r->name ?></a></td>
                <td><?php echo format_date($r->time, true) ?></td>
                <td><a target="_blank" href="<?php echo $r->url ?>"><?php echo $r->name ?></a></td>
                <td><a href="mailto:<?php echo $r->email; ?>"><?php echo $r->email;?></a></td>
                <td><?php echo $r->body ?></td>
                <td><a class="btn btn-primary btn-sm" href="<?php echo $r->url ?>/edit?destination=admin/posts"><?php echo i18n('Edit');?></a> <a
                        class="btn btn-danger btn-sm" href="<?php echo $r->url ?>/delete?destination=admin/posts"><?php echo i18n('Delete');?></a></td>
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php if (!empty($pagination['prev']) || !empty($pagination['next'])): ?>
<br>
    <div class="pager">
	<ul class="pagination">
        <?php if (!empty($pagination['prev'])) { ?>
            <li class="newer page-item"><a class="page-link" href="?page=<?php echo $page - 1 ?>" rel="prev">&#8592; <?php echo i18n('Newer');?></a></li>
        <?php } else { ?>
		<li class="page-item disabled" ><span class="page-link">&#8592; <?php echo i18n('Newer');?></span></li>
		<?php } ?>
        <li class="page-number page-item disabled"><span class="page-link"><?php echo $pagination['pagenum'];?></span></li>
        <?php if (!empty($pagination['next'])) { ?>
            <li class="older page-item" ><a class="page-link" href="?page=<?php echo $page + 1 ?>" rel="next"><?php echo i18n('Older');?> &#8594;</a></li>
        <?php } else { ?>
			<li class="page-item disabled" ><span class="page-link"><?php echo i18n('Older');?> &#8594;</span></li>
		<?php } ?>
		</ul>
    </div>
<?php endif; ?>
<?php } else {
    echo i18n('No_comments_found') . '!';
} ?>