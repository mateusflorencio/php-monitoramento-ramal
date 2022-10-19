$.ajax({
    url: "./src/main/index.php",
    type: "GET",
    success: function(data){                
        for(let i in data){
            $('#cartoes').append(`<div class="${['cartao', 'bg_' + data[i].status].join(' ')}">
                                <div>${data[i].userName}</div>
                                <span class="${data[i].status} icone-posicao"></span>
                              </div>`)
        }
        
    },
    error: function(e){
        console.log(e)
    }
});