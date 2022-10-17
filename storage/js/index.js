import "../scss/styles.scss";
import "../css/bootstrap.min.css";

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.parse-form');

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        let formData = new FormData();
        let parseData = "N";
        let parseType = "N";
        let types = "";

        const sel = document.querySelectorAll('.parse-form__option');
        for (let i = 0; i < sel.length; i++) {
            if(sel[i].selected) {
                types = types + sel[i].textContent + "|";
            }
        }

        if(types.slice(-1) == '|'){
            types = types.slice(0,-1);
        }

        if (document.querySelector('#parse-data').checked) {
            parseData = "Y";
        }

        if (document.querySelector('#parse-type').checked) {
            parseType = "Y";
        }

        document.querySelector('#app').innerHTML = xhrRequest({
            usedata: parseData,
            usetype: parseType,
            parse: document.querySelector('.parse-form__input').value,
            types: types
        });

    });

    function xhrRequest(params, send = null) {
        let url = 'http://parser.loc/?';
        for (let key in params) {
            url = url + "&" + key + "=" + params[key];
        }
        const xhr = new XMLHttpRequest();
        let requestURL = new URL("", url);
        xhr.open('GET', requestURL, false);
        xhr.send(send);
        return xhr.response;
    }
});