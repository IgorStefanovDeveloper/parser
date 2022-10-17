<form class="parse-form" method="get">
    <p class="parse-form__message">Введите полный путь к странице(с http://...), с которой надо скачать картинки.</p>
    <input class="parse-form__input" type="text" name="parse">
    <label class="parse-form__label" for="parse-data">
        Парсить картинки с Data URL схем(data:image...)?
        <input class="parse-form__checkbox" id="parse-data" type="checkbox" checked="checked" value="yes">
    </label>
    <label class="parse-form__label" for="parse-type">
        Парсить картинки определенного типа(jpg,png...)?
        <input class="parse-form__checkbox" id="parse-type" type="checkbox" value="yes">
    </label>
    <select class="parse-form__select" name="types" size="4" multiple>
        <option class="parse-form__option" value="jpg" selected="selected">jpg</option>
        <option class="parse-form__option" value="png" selected="selected">png</option>
        <option class="parse-form__option" value="svg" selected="selected">svg</option>
        <option class="parse-form__option" value="jpeg" selected="selected">jpeg</option>
    </select>
    <button class="parse-form__submit">Спарсить</button>
</form>
