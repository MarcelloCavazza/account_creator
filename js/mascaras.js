function mascara_telefone (){
    //limitador
    var tel = document.getElementById("telefone").value;
    tel=tel.slice(0,14); //(pode limitar a quantidade de char na entrada pelo java script)
    document.getElementById("telefone").value=tel;
    //máscara
    var tel_formatado = document.getElementById("telefone").value
    if (tel_formatado[0]!="("){
        if(tel_formatado[0]!=undefined){
            document.getElementById("telefone").value="("+tel_formatado[0];
        }
    }
    if (tel_formatado[3]!=")"){
        if(tel_formatado[3]!=undefined){
            document.getElementById("telefone").value=tel_formatado.slice(0,3)+")"+tel_formatado[3]
        }
    }
    if (tel_formatado[9]!="-"){
        if(tel_formatado[9]!=undefined){
            document.getElementById("telefone").value=tel_formatado.slice(0,9)+"-"+tel_formatado[9]
        }
    }
}