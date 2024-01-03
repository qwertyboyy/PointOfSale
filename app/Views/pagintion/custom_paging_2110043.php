<?php $pager->setSurroundCount(2) ?>
<nav aria-label="<?= lang('Page.pageNavigation') ?>">
    <ul class="pagination">
        <?php if($pager->hasPreviousPage()) : ?>
        <li class="page-item">
            <a href="<?= $pager->getFirst()?>" class="page-link" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true"><?= lang('Page first') ?></span>
            </a>
        </li>
        <li class="page-item">
            <a href="<?= $pager->getPreviousPage()?>" class="page-link" aria-label="<?= lang('Pager.previous') ?>">
                <span aria-hidden="true"><?= lang('Page previous') ?></span>
            </a>
        </li>
        <?php endif ?>

        <?php foreach($pager->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="active page-item"' : '' ?>>
            <a href="<?= $link['uri']?>" class="page-link">
                <?= $link['title'] ?>
            </a>
        </li>
        <?php endforeach ?>
        <?php if ($pager->hasNextPage()) : ?>
        <li class="page-item">
            <a href="<?= $pager->getNextPage() ?>" class="page-link" aria-label="<?= lang('Pager.next') ?>">
                <span aria-hidden="true"><?= lang('Pager.next') ?></span>
            </a>
        </li>
        <li class="page-item">
            <a href="<?= $pager->getLast() ?>" class="page-link" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true"><?= lang('Pager.last') ?></span>
            </a>
        </li>
        <?php endif ?>
    </ul>
</nav>