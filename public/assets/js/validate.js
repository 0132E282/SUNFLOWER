function validate(option) {
    ((option)=>{
        const form = document.forms[option.form];
        option.rules.forEach(rule => {
            const input = document.querySelector(`input[name="${rule.name}"]`);
            input.onblur = function (e) { 
              const messenger =  rule.test(e.target.value); 
              console.log(messenger);
            };
        });
        form.onsubmit = function (e){
            e.preventDefault();
        }
    })(option)
};
validate.require = function (name) {
    return {
        name,
        test :  function (value){
            return value.trim() === '' ? 'vui lồng nhâp nội dung' : '';
        }
    }
}
validate.minLength = function (name , min) {
    return {
        name,
        test :  function (value){
            return value.length < min ? `độ dài phải lớn hơn ${min}`: '';
        }
    }
}
validate.isNumber = function (name) {
    return {
        name,
        test :  function (value){
            const regEx = /\D/;
            return regEx.test(value) ? `nhập vào phải là số`: '';
        }
    }
}