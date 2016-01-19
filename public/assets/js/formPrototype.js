var formPrototype = function(form) {
    this.form = form;
    this.data = {};
    this.errors = [];
    this.errorDictionary = {};
    this.errorContainer = document.querySelector('div.errors');
};

formPrototype.prototype.collectData = function() {
};

formPrototype.prototype.isValid = function() {
    return true;
};

formPrototype.prototype.resetErrors = function() {
    this.errorContainer.innerText = '';
    if (!this.errorContainer.classList.contains('hide')) {
        this.errorContainer.classList.add('hide');
    }
};

formPrototype.prototype.showErrors = function(errors) {
    var self = this;

    if (undefined != errors && 0 < errors.length) {
        var errorContainerHtml = '<ul>';
        errors.forEach(function (errorKey) {
            if (undefined != self.errorDictionary[errorKey]) {
                errorContainerHtml += '<li>' + self.errorDictionary[errorKey] + '</li>';
            }
        });
        errorContainerHtml += '</ul>';
        this.errorContainer.innerHTML = errorContainerHtml;

        if (this.errorContainer.classList.contains('hide')) {
            this.errorContainer.classList.remove('hide');
        }
    }
};

formPrototype.prototype.submit = function(isXhr, url, onSuccess) {
    var self = this;

    this.resetErrors();
    this.collectData();
    if (this.isValid()) {
        if (isXhr) {
            xhr.sendAsyncRequest(url, 'POST', this.data, onSuccess, function (response) {
                self.showErrors(response.errors);
            });
        } else {
            self.form.submit();
        }
    }
};