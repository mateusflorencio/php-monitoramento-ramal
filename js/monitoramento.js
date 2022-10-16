$.ajax({
    url: "./src/main/index.php",
    type: "GET",
    success: function(data){                
        for(let i in data){
            $('#cartoes').append(`<div class="${['cartao', 'bg_' + data[i].status].join(' ')}">
                                <div>${data[i].nome}</div>
                                <span class="${data[i].status} icone-posicao"></span>
                                <div class="agente">${data[i].agente}</div>
                              </div>`)
        }
        
    },
    error: function(e){
        console.log(e)
    }
});