var helper = {

    construct: function () {
    },

    resetForm: function (idForm) {
        document.getElementById(idForm).reset();
        $(".select2-hidden-accessible").val('').trigger('change')
    },

    upperCase: function (value) {
        if (value != null) {
            return value.toUpperCase();
        }
        return value;
    },

    formatStringStatus: function (value) {
        const expr = value;
        let response = null;
        switch (expr) {
            case 'S':
                response = 'SIM';
                break;
            case 'N':
                response = 'NÃO';
                break;
            case 'A':
                response = 'ATIVO';
                break;
            case 'I':
                response = 'INATIVO';
                break;
        }
        return response;
    },

    formatCnpjCpf: function (value) {
        if (value !== null) {
            const CPF_LENGTH = 11;
            const cnpjCpf = value.replace(/\D/g, '');

            if (cnpjCpf.length === CPF_LENGTH) {
                return cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
            }

            return cnpjCpf.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
        }
        return
    },

    toastAlertSuccess: function(text){
        Swal.mixin({
            toast: true,
            icon: 'success',
            title: text,
            animation: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    },

    toastAlertError: function(text){
        Swal.mixin({
            toast: true,
            icon: 'error',
            title: text,
            animation: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    },

    alertSuccess: function (text) {
        Swal.fire({
            icon: 'success',
            title: 'Aviso',
            text: text,
        })
    },

    alertError: function (text) {
        Swal.fire({
            icon: 'error',
            title: 'Alerta',
            text: text,
        })
    },

    alertWarning: function (text) {
        Swal.fire({
            icon: 'warning',
            title: 'Alerta',
            text: text,
        })
    },

    alertInformation: function (text) {
        Swal.fire({
            icon: 'info',
            title: 'Aviso',
            text: text,
        })
    },
    dateToBr: function (date) {
        if (date == null) return null;

        var data = new Date(date),
            dia = data.getDate().toString(),
            diaF = (dia.length == 1) ? '0' + dia : dia,
            mes = (data.getMonth() + 1).toString(), //+1 pois no getMonth Janeiro começa com zero.
            mesF = (mes.length == 1) ? '0' + mes : mes,
            anoF = data.getFullYear();
        return diaF + "/" + mesF + "/" + anoF;
    },

    formatCurrencyPtBr: function (number) {
        return new Intl.NumberFormat('pt-br', { style: 'currency', currency: 'BRL' }).format(number)
    },

    converteMoedaFloat: function (valor) {

        if (valor === "") {
            valor = 0;
        } else {
            valor = valor.replace(".", "");
            valor = valor.replace(",", ".");
            valor = parseFloat(valor);
        }
        return valor;

    },

    converteFloatMoeda: function (valor) {
        var inteiro = null, decimal = null, c = null, j = null;
        var aux = new Array();
        valor = "" + valor;
        c = valor.indexOf(".", 0);
        //encontrou o ponto na string
        if (c > 0) {
            //separa as partes em inteiro e decimal
            inteiro = valor.substring(0, c);
            decimal = valor.substring(c + 1, valor.length);
        } else {
            inteiro = valor;
        }

        //pega a parte inteiro de 3 em 3 partes
        for (j = inteiro.length, c = 0; j > 0; j -= 3, c++) {
            aux[c] = inteiro.substring(j - 3, j);
        }

        //percorre a string acrescentando os pontos
        inteiro = "";
        for (c = aux.length - 1; c >= 0; c--) {
            inteiro += aux[c] + '.';
        }
        //retirando o ultimo ponto e finalizando a parte inteiro

        inteiro = inteiro.substring(0, inteiro.length - 1);

        decimal = parseInt(decimal);
        if (isNaN(decimal)) {
            decimal = "00";
        } else {
            decimal = "" + decimal;
            if (decimal.length === 1) {
                decimal = decimal + "0";
            }
        }


        valor = inteiro + "," + decimal;


        return valor;

    },

    roundNumber: function (rnum) {

        return Math.round(rnum * Math.pow(10, 2)) / Math.pow(10, 2);

    },

    isDate: function (txtDate) {
        var currVal = txtDate;
        if (currVal == '') {
            return false;
        }
        var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
        var dtArray = currVal.match(rxDatePattern); // is format OK?

        if (dtArray == null) {
            return false;
        }

        dtDay = dtArray[1];
        dtMonth = dtArray[3];
        dtYear = dtArray[5];

        if (dtMonth < 1 || dtMonth > 12) {
            return false;
        } else if (dtDay < 1 || dtDay > 31) {
            return false;
        } else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31) {
            return false;
        } else if (dtMonth == 2) {
            var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
            if (dtDay > 29 || (dtDay == 29 && !isleap))
                return false;
        }

        return true;
    },

};


$(document).ready(function () {
    helper.construct();
});




