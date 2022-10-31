class YandexDisk {
    setObservers() {
        const provider = `yandex`;
        const authBtn = document.querySelector('.js-yandex-auth-link');
        const tokenBtn = document.querySelector('.js-yandex-auth-token');
        const downloadToYandexBtns = document.querySelectorAll('.actions__btn');

        downloadToYandexBtns.forEach((button) => {
            button.addEventListener('click', () => {
                //
                //let link = link
                let item = button.closest('.info-table__row');
                let anchor = item.querySelector('.link');
                let link = anchor.getAttribute('href');

                let body = {
                    action: "load",
                    link: link,
                    accessCode: readCookie('code')
                };

                this.sendJSON(body, `load`, provider);
            });
        });

        if(!!authBtn) {
            authBtn.addEventListener('click', () => {
                let body = {
                    action: "auth",
                    site: `https://parser.ru/`
                };

                this.sendJSON(body, `auth`, provider);
            });
        }
        if(!!tokenBtn) {
            tokenBtn.addEventListener('click', () => {
                window.location = tokenBtn.getAttribute("data-href")
            });
        }

        var gets = (function () {
            var a = window.location.search;
            var b = new Object();
            a = a.substring(1).split("&");
            for (var i = 0; i < a.length; i++) {
                let c = a[i].split("=");
                b[c[0]] = c[1];
            }
            return b;
        })();

        if (gets.code != undefined && readCookie("code") == undefined) {
            let body = {
                action: "code",
                code: gets.code
            };

            this.sendJSON(body, `code`, provider);
        }

    }

    sendJSON(dataObj, action, provider) {
        let result = document.querySelector('.js-result');
        let xhr = new XMLHttpRequest();

        let url = `https://provider.ru/api/` + provider + `/` + action;

        xhr.open("POST", url, true);
        xhr.responseType = "json";
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status == 200) {
                if (!!xhr.response) {
                    if (!!xhr.response.link) {
                        document.querySelector(".js-yandex-auth-token").setAttribute(`data-href`, xhr.response.link);
                    }

                    if (!!xhr.response.code) {
                        writeCookie(`code`, xhr.response.code, 30)
                    }

                    if (!!xhr.response.load) {
                        alert(xhr.response.load);
                    }
                }
            }
        };

        let data = JSON.stringify(dataObj);

        xhr.send(data);
    }
}

function writeCookie(name, val, expires) {
    let date = new Date;
    date.setDate(date.getDate() + expires);
    document.cookie = name + "=" + val + "; path=/; expires=" + date.toUTCString();
}

function readCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}


export default YandexDisk;