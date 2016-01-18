var xhr = {
    sendAsyncRequest: function(url, method, data, onSuccess, onFail) {
        var xmlHttp = new XMLHttpRequest();

        xmlHttp.open(method, url, true);
        xmlHttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        xmlHttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xmlHttp.send(JSON.stringify(data));

        xmlHttp.onreadystatechange = function() { // (3)
            if (xmlHttp.readyState != 4) {
                return;
            }

            try {
                var response = JSON.parse(xmlHttp.responseText);
            } catch (e) {
                response = {};
            }

            if (undefined != response.success && response.success === false && undefined != onFail) {
                return onFail(response);
            }

            if (undefined != onSuccess) {
                return onSuccess(response);
            }
        };
    }
};