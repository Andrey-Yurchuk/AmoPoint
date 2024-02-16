// Функция для отправки данных на сервер
function sendDataToServer(data) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "backend.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
}

// Функция для получения данных о посетителе
function getVisitorData() {
    // Получение IP-адреса посетителя с помощью ipify.org
    const ipifyUrl = "https://api.ipify.org?format=json";
    fetch(ipifyUrl)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            const ip = data.ip;

            // Получение города и других данных о посетителе с помощью ipapi.com
            const ipapiUrl = "https://ipapi.co/" + ip + "/json/";
            fetch(ipapiUrl)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    const city = data.city;
                    const device = navigator.userAgent;

                    const visitorData = {
                        ip: ip,
                        city: city,
                        device: device
                    };

                    sendDataToServer(visitorData);
                });
        });
}

getVisitorData();
