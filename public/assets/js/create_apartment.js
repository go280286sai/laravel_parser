// let AI_LOCAL = import.meta.env.VITE_URL_PYTHON;

Vue.createApp({
    methods:{
        getPredict(dollar)
{
    let rooms = $('#rooms').val();
    let floor = $('#floor').val();
    let etajnost = $('#etajnost').val();
    let area = $('#area').val();
    let location = $('#location').val();
    let obj = {
        "rooms": rooms, 'floor': floor, 'etajnost': etajnost,
        'area': area, 'location': location
    }
    $.ajax({
        url: 'http://192.168.0.107:8000/predictApartment',
        headers: {
            "Content-Type": "application/json; charset=utf-8"
        },
        method: "POST",
        data: JSON.stringify(obj),
        success: (data) => {
            data = JSON.parse(data);
            const rate = dollar;
            let price = data.result;
            $('#predict_result').html(
                `<p><b>Возможная цена с учетом параметров: <strong class="text-red">${Math.round(price)}грн. или ${Math.round((price) / rate)}$</strong>`)
        },
        error: function (xhr, status, error) {
            console.log(error); // выводим сообщение об ошибке в консоль
        }
    })
}
    }

}).mount('#create_apartment')

