function mascara_telefone ()
        {
           //limitador
         var tel = document.getElementById("telefone").value
            console.log(tel)
          tel=tel.slice(0,14) //(pode limitar a quantidade de char na entrada pelo java script)
            console.log(tel)
          document.getElementById("telefone").value=tel
     tel=document.getElementById("telefone").value.slice(0,10)
            console.log(tel)
           
            //máscara
            var tel_formatado = document.getElementById("telefone").value
            if (tel_formatado[0]!="(")
            {
                if(tel_formatado[0]!=undefined)
                {
                    document.getElementById("telefone").value="("+tel_formatado[0];
                }
            }

            if (tel_formatado[3]!=")")
            {
                if(tel_formatado[3]!=undefined)
                {
                    document.getElementById("telefone").value=tel_formatado.slice(0,3)+")"+tel_formatado[3]
                }
            }

            if (tel_formatado[9]!="-")
            {
                if(tel_formatado[9]!=undefined)
                {
                    document.getElementById("telefone").value=tel_formatado.slice(0,9)+"-"+tel_formatado[9]
                }
            }
        }


       //Mascara do evento "oninput" que é ativada a cada termo digitado
        function mascara_dinheiro_cifrao ()
        {
            //máscara para inserir o R$ no começo
            var dinheiro_formatado = document.getElementById("dinheiro").value
            //Se o primeiro termo não for o R, ele insere o R$
            if (dinheiro_formatado[0]!="R")
            {
                if(dinheiro_formatado[0]!=undefined)
                {
                    document.getElementById("dinheiro").value="R$"+dinheiro_formatado[0];
                }
            }
            //Se o segundo termo não for o $, ele mantém o R anterior e insere o $ para ficar R$
            if (dinheiro_formatado[1]!="$")
            {
                if(dinheiro_formatado[1]!=undefined)
                {
                    document.getElementById("dinheiro").value=dinheiro_formatado[0]+"$"+dinheiro_formatado[1];
                }
            }
        }
        //Mascara do evento "onchange" que é ativada quando termina de digitar e clica fora
        function mascara_dinheiro_virgula ()
        {
            var dinheiro_formatado = document.getElementById("dinheiro").value;

            //procura se tem alguma virgula
            if (dinheiro_formatado[dinheiro_formatado.length-3]!=",") 
            {
                //pega o tamanho do array -3 como indice e pega o antipenultimo valor do input, ou seja "_xx"
                //Se ele for diferente de "," ele entra dentro do if
                if (dinheiro_formatado[dinheiro_formatado.length-2]==",") 
                {
                    //pega o tamanho do array -2 como indice e pega o penultimo valor do input, ou seja "x_x"
                    //como o antipenultimo termo não é virgula, estou conferindo se o penultimo é
                    //se for, entra aqui neste if, então eu tenho um final "x,x", ai basta adicionar um "0"
                    document.getElementById("dinheiro").value = dinheiro_formatado+"0";
                }
                else
                {
                    //se o penultimo não for a virgula, tenho que conferir se o ultimo é a vírgula
                    //então só entra neste else se o penultimo termo n for virgula, ou seja "xxx"
                    if (dinheiro_formatado[dinheiro_formatado.length-1]==",") 
                    {
                        //pega o tamanho do array -1 como indice e pega o ultimo valor do input, ou seja "xx_"
                        //como o antipenultimo termo e o penultimo termo não são virgula, estou conferindo se o ultimo é
                        //se for, entra aqui neste if, então eu tenho um final "xx,", ai basta adicionar um "00"
                        document.getElementById("dinheiro").value = dinheiro_formatado+"00";
                    }
                    else
                    {
                        //se o ultimo não for a virgula, tenho que inserir o ",00"
                        document.getElementById("dinheiro").value = dinheiro_formatado+",00";
                    }
                }

            }
            //aqui poderia entrar um else mostrando q o termo final é ",xx", só q se já for ",xx" a configuração está certa e não tem que fazer nada
        }