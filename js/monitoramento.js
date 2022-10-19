$.ajax({
    url: "./src/main/index.php",
    type: "GET",
    success: function(data){                
        for(let i in data){
            $('#cartoes').append(`<div class="${['cartao', 'bg_' + data[i].status].join(' ')}">
                                <div>${data[i].ramal}</div>
                                <div>${data[i].userName}/${data[i].agente}</div>
                                <span>Calls: ${data[i].historico}</span>
                                <span class="${data[i].status} icone-posicao"></span>
                              </div>`)
        }
        
    },
    error: function(e){
        console.log(e)
    }
});