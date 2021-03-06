//TODO: vee-validate está barrando o ç no alpha*

export default {

    after: function(e, r) {
        var n = r[0];
        return "O campo " + e + " deve estar depois do campo " + n + "."
    },
    alpha_dash: function(e) {
        return "O campo " + e + " deve conter letras, números e traços."
    },
    alpha_num: function(e) {
        return "O campo " + e + " deve conter somente letras e números."
    },
    alpha_spaces: function(e) {
        return "The " + e + " só pode conter caracteres alfabéticos e espaços."
    },
    alpha: function(e) {
        return "O campo " + e + " deve conter somente letras."
    },
    before: function(e, r) {
        var n = r[0];
        return "O campo " + e + " deve estar antes do campo " + n + "."
    },
    between: function(e, r) {
        var n = r[0],
            o = r[1];
        return "O campo " + e + " deve estar entre " + n + " e " + o + "."
    },
    confirmed: function(e, r) {
        var n = r[0];
        return "O campo " + e + " e " + n + " devem ser iguais."
    },
    credit_card: function(e) {
        return "O campo " + e + " é inválido."
    },
    date_between: function(e, r) {
        var n = r[0],
            o = r[1];
        return "O campo " + e + " deve estar entre " + n + " e " + o + "."
    },
    date_format: function(e, r) {
        var n = r[0];
        return "O campo " + e + " deve estar no formato " + n + "."
    },
    decimal: function(e, r) {
        void 0 === r && (r = ["*"]);
        var n = r[0];
        return "O campo " + e + " deve ser numérico e deve conter " + ("*" === n ? "" : n) + " casas decimais."
    },
    digits: function(e, r) {
        var n = r[0];
        return "O campo " + e + " deve ser numérico e ter " + n + " dígitos."
    },
    dimensions: function(e, r) {
        var n = r[0],
            o = r[1];
        return "O campo " + e + " deve ter " + n + " pixels de largura por " + o + " pixels de altura."
    },
    email: function(e) {
        return "O campo " + e + " deve ser um email válido."
    },
    ext: function(e) {
        return "O campo " + e + " deve ser um arquivo válido."
    },
    image: function(e) {
        return "O campo " + e + " deve ser uma imagem."
    },
    in: function(e) {
        return "O campo " + e + " deve ter um valor válido."
    },
    ip: function(e) {
        return "O campo " + e + " deve ser um endereço IP válido."
    },
    max: function(e, r) {
        var n = r[0];
        return "O campo " + e + " não deve ter mais que " + n + " caracteres."
    },
    max_value: function(e, r) {
        var n = r[0];
        return "O campo " + e + " precisa ser " + n + " ou menor."
    },
    mimes: function(e) {
        return "O campo " + e + " deve ser um tipo de arquivo válido."
    },
    min: function(e, r) {
        var n = r[0];
        return "O campo " + e + " deve conter pelo menos " + n + " caracteres."
    },
    min_value: function(e, r) {
        var n = r[0];
        return "O campo " + e + " precisa ser " + n + " ou maior."
    },
    not_in: function(e) {
        return "O campo " + e + " deve ser um valor válido."
    },
    numeric: function(e) {
        return "O campo " + e + " deve conter apenas números"
    },
    regex: function(e) {
        return "O campo " + e + " possui um formato inválido."
    },
    required: function(e) {
        return "O campo " + e + " é obrigatório."
    },
    size: function(e, r) {
        var n = r[0];
        return "O campo " + e + " deve ser menor que " + n + " KB."
    },
    url: function(e) {
        return "O campo " + e + " não é uma URL válida."
    }
};
