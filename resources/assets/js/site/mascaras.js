//Máscaras
window.Mascara = function(o,f){
	let v_obj=o
	let v_fun=f
	setTimeout(execmascara(v_obj, v_fun),1)
}

window.Tempo = function(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{1})(\d{2})(\d{2})/,"$1:$2.$3");
    return v;
}

window.Hora = function(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1:$2");
    return v;
}

window.execmascara = function(v_obj, v_fun){
	v_obj.value=v_fun(v_obj.value)
}

window.leech = function(v){
	v=v.replace(/o/gi,"0")
	v=v.replace(/i/gi,"1")
	v=v.replace(/z/gi,"2")
	v=v.replace(/e/gi,"3")
	v=v.replace(/a/gi,"4")
	v=v.replace(/s/gi,"5")
	v=v.replace(/t/gi,"7")
	return v
}

window.Integer = function(v){
	return v.replace(/\D/g,"")
}

window.Login = function(v){
	return v.replace(/\W/g,"")
}

window.Telefone = function(v){
	v=v.replace(/\D/g,"")
	v=v.replace(/^(\d\d)(\d)/g,"($1) $2")

	if (v.length == 13) {
		v=v.replace(/(\d{4})(\d)/,"$1-$2")
	} else if(v.length == 14) {
		v=v.replace(/(\d{1})(\d{4})(\d)/,"$1$2-$3")
	}

	return v
}

window.Cpf = function(v){
	v=v.replace(/\D/g,"")
	v=v.replace(/(\d{3})(\d)/,"$1.$2")
	v=v.replace(/(\d{3})(\d)/,"$1.$2")
	v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
	return v
}

window.CardNumber = function(v){
	v=v.replace(/\D/g,"")
	v=v.replace(/(\d{4})(\d)/,"$1 $2")
	v=v.replace(/(\d{4})(\d)/,"$1 $2")
	v=v.replace(/(\d{4})(\d)/,"$1 $2")
	return v
}

window.Cnpj = function(v){
	v=v.replace(/\D/g,"")
	v=v.replace(/^(\d{2})(\d)/,"$1.$2")
	v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
	v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
	v=v.replace(/(\d{4})(\d)/,"$1-$2")
	return v
}

window.Cep = function(v){
	v=v.replace(/\D/g,"")
	v=v.replace(/^(\d{5})(\d)/,"$1-$2")
	return v
}

window.Data = function(v){
	v=v.replace(/\D/g,"")
	v=v.replace(/(\d{2})(\d)/,"$1/$2")
	v=v.replace(/(\d{2})(\d)/,"$1/$2")
	return v
}

window.checkMail = function(mail){
	var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	if(typeof(mail) == "string"){
		if(er.test(mail)){ return true; }
	}else if(typeof(mail) == "object"){
		if(er.test(mail.value)){
			return true;
		}
	}else{
		return false;
	}
}

window.Valor = function(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    v=v.replace(/(\d)(\d{10})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{7})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{4})$/,"$1.$2");//coloca o ponto dos milhares

    v=v.replace(/(\d)(\d{1})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return v;
}
