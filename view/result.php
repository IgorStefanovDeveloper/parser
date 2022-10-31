<?php
if (!isset($images) || isset($images) && !is_array($images)) {
    echo "<p>Изображения не найдены</p>";
    return false;
}
?>
<div class="info-str">
    <div class="info-str__current-page">Текущая страница: <a class="info-str__link link" href="<?= $_GET['parse'] ?>"
                                                             target="_blank"><?= $_GET['parse'] ?></a></div>
</div>
<div class="actions">
    <div class="actions__btn">Скачать все</div>
    <div class="actions__btn"><a class="info-str__link link" href="/">Вернутся к вводу адреса</a></div>
</div>
<div class="info-table">
    <?php
    foreach ($images as $key => $img) {
        ?>
        <div class="info-table__row">
            <div class="info-table__column">
                <span class="iterator"><?= $key + 1 ?>.</span>
                <p class="info-table__string"><a class="link" href="<?= $img ?>"><?= $img ?></a></p>
            </div>
            <div class="info-table__column">
                <img class="info-table__pic" src="<?= $img ?>" width="100" height="100">
            </div>
            <div class="info-table__column">
                <div class="actions">
                    <div class="actions__btn">Загрузить на яндекс диск</div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

