var registerFormObject = function (form) {
    formPrototype.apply(this, arguments);

    this.errorDictionary = {
        'name.required': 'Name is required',
        'last_name.required': 'Last name is required',
        'email.required': 'Email is required',
        'email.email': 'Email not correct',
        'password.required': 'Password is required',
        'password.confirmed': 'Passwords are mismatched'
    };

    this.collectData = function () {
        this.data = {
            name: document.getElementsByName("name")[0].value,
            last_name: document.getElementsByName("last_name")[0].value,
            email: document.getElementsByName("email")[0].value,
            password: document.getElementsByName("password")[0].value,
            password_confirmed: document.getElementsByName("password_confirmed")[0].value
        };
    };

    this.isValid = function () {
        this.errors = [];

        if (undefined == this.data.name || 0 === this.data.name.length) {
            this.errors.push('name.required');
        }

        if (undefined == this.data.last_name || 0 === this.data.last_name.length) {
            this.errors.push('last_name.required');
        }

        if (undefined == this.data.email || 0 === this.data.email.length) {
            this.errors.push('email.required');
        }

        if (undefined == this.data.password || 0 === this.data.password.length) {
            this.errors.push('password.required');
        }

        if (undefined != this.data.password && undefined != this.data.password_confirmed
            && 0 < this.data.password.length
            && this.data.password !== this.data.password_confirmed)
        {
            this.errors.push('password.confirmed');
        }

        if (0 === this.errors.length) {
            return true;
        }

        this.showErrors(this.errors);

        return false;
    };

    var self = this;

    document.getElementById('js-register').addEventListener("click", function() {
        self.submit(false);
    });
};
registerFormObject.prototype = Object.create(formPrototype.prototype);
new registerFormObject(document.getElementById('registerForm'));
