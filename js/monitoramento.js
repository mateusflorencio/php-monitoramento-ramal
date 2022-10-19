const load = ()=> {
    $('#wrap_time').append(`<div class='time'>Atualizado às ${new Date().toLocaleTimeString()} - ${new Date().toLocaleDateString()} </div>`)
    $.ajax({
        url: "./src/main/index.php",
        type: "GET",
        success: function(data){ 
            for(let i in data){
                $('#cartoes').append(`<div class="${['cartao', 'bg_' + data[i].status].join(' ')}">
                                    <div>${data[i].ramal}</div>
                                    <div>${data[i].username}/${data[i].agente}</div>
                                    <span>Calls: ${data[i].historico}</span>
                                    <span class="${data[i].status} icone-posicao"></span>
                                    </div>`)
            }
        },
        error: function(e){
            console.log(e)
        }
    });
}

window.onload = load()

setInterval(()=>{
    $('#cartoes').empty()
    $('#wrap_time').empty()
    load()
}, 1000 * 10)


