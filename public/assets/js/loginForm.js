var loginFormObject = function (form) {
    formPrototype.apply(this, arguments);

    this.errorDictionary = {
        'email.required': 'Email is required',
        'email.email': 'Email not correct',
        'password.required': 'Password is required',
        'user.not_found': 'User not found'
    };

    this.collectData = function () {
        this.data = {
            email: document.getElementsByName("email")[0].value,
            password: document.getElementsByName("password")[0].value
        };
    };

    this.isValid = function () {
        this.errors = [];

        if (undefined == this.data.email || 0 === this.data.email.length) {
            this.errors.push('email.required');
        }

        if (undefined == this.data.password || 0 === this.data.password.length) {
            this.errors.push('password.required');
        }

        if (0 === this.errors.length) {
            return true;
        }

        this.showErrors(this.errors);

        return false;
    };

    var self = this;

    document.getElementById('js-login').addEventListener("click", function() {
        self.submit(true, '/login', function (response) {
            window.location.href = response.redirect;
        });
    });
};
loginFormObject.prototype = Object.create(formPrototype.prototype);
new loginFormObject(document.getElementById('loginForm'));