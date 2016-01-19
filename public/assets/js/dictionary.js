var dictionary = {
    elements: {},

    ru: {
        linkBackToIndex: 'Назад на главную страницу',

        registrationTitle: 'Регистрация',
        loginTitle: 'Авторизация',
        selectLanguage: 'Сменить язык',

        registrationFieldName: "Имя",
        registrationFieldLastName: 'Фамилия',
        registrationFieldMiddleName: 'Отчество',
        registrationFieldEmail: 'Эл. почта',
        registrationFieldPassword: 'Пароль',
        registrationFieldPasswordConfirmed: 'Подтверждение пароля',
        registrationFieldBirthYear: 'Год рождения',
        registrationFieldLocation: 'Место жительство',
        registrationFieldMaritalStatus: 'Семейный статус',
        registrationFieldEducation: 'Образование',
        registrationFieldExperience: 'Опыт работы',
        registrationFieldPhone: 'Телефон',
        registrationFieldAdditional: 'Дополнительные сведения',
        registrationFieldFilename: 'Фотография',

        registrationButtonSubmit: 'Зарегистрироваться',

        loginFieldEmail: 'Эл. почта',
        loginFieldPassword: 'Пароль',
        loginButtonSubmit: 'Авторизоваться'
    },
    en: {
        linkBackToIndex: 'Back to index page',

        registrationTitle: 'Sign in',
        loginTitle: 'Login',
        selectLanguage: 'Change language',

        registrationFieldName: 'Name',
        registrationFieldLastName: 'Last Name',
        registrationFieldMiddleName: 'Middle Name',
        registrationFieldEmail: 'Email',
        registrationFieldPassword: 'Password',
        registrationFieldPasswordConfirmed: 'Password confirmed',
        registrationFieldBirthYear: 'Birth year',
        registrationFieldLocation: 'Location',
        registrationFieldMaritalStatus: 'Marital status',
        registrationFieldEducation: 'Education',
        registrationFieldExperience: 'Experience',
        registrationFieldPhone: 'Phone',
        registrationFieldAdditional: 'Additional',
        registrationFieldFilename: 'Photo',

        registrationButtonSubmit: 'Sign in',

        loginFieldEmail: 'Email',
        loginFieldPassword: 'Password',
        loginButtonSubmit: 'Login'
    },

    init: function () {
        var self = this;

        window.addEventListener('load', function (){
            self.elements = document.querySelectorAll('[data-key]');
        });
    },

    choose: function (key, language) {
        if (undefined == language || undefined == this[language]) {
            language = 'en';
        }

        if (undefined != this[language][key]) {
            return this[language][key];
        }
    },

    switchLanguage: function (language) {
        var element, translate;

        for (var i = 0; i < this.elements.length; i++) {
            element = this.elements[i];
            translate = this.choose(element.getAttribute('data-key'), language);

            if (undefined != translate) {
                element.innerHTML = translate;
            }
        }
    }
};

dictionary.init();