function getPredict(email) {
    let rooms = $('#rooms').val();
    let etajnost = $('#etajnost').val();
    let price = $('#price').val();
    let location = $('#location').val();
    let object = {'rooms': rooms, 'etajnost': etajnost, 'price': price, 'location': location};
    axios.post('http://192.168.0.107:8000/getPredict', JSON.stringify(object)).then(df => {
        axios.post('/user/getApartment', {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'text': df.data
        }).then(data => {
            let text = `<form action="/user/getApartment" method="post">
@csrf`;
            text += `<table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr class="bg-orange-400">
                            <th scope="col">Название</th>
                            <th scope="col">Комнаты</th>
                            <th scope="col">Этаж</th>
                            <th scope="col">Этажность</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Расположение</th>
                        </tr>
                        </thead>
                        <tbody>`;
            let list = '';
            for (let index in data.data[0]) {
                list += data.data[0][index].id + ',';
                text +=
                    `<tr>
                            <td class="bg-orange-200"><a href="${data.data[0][index].url}" target="_blank">${data.data[0][index].title}</a></td>
                            <td class="bg-orange-200">${data.data[0][index].rooms}</td>
                            <td class="bg-orange-200">${data.data[0][index].floor}</td>
                            <td class="bg-orange-200">${data.data[0][index].etajnost}</td>
                            <td class="bg-orange-200">${data.data[0][index].description}</td>
                            <td class="bg-orange-200">${data.data[0][index].price}</td>
                            <td class="bg-orange-200">${data.data[0][index].location}</td>
                            </tr>`
                ;
            }


            text += `</tbody>
                    </table>`;
            text += `<input type="hidden" name="data" value="${list}">
<input type="hidden" name="email" value="${email}">
<br> ${(email !== false )? '<input class="btn btn-danger" type="submit" value="Отправить на почту">' : ''}
</form>`;
            $('#body').html(text);
        })
    }).catch(err => {
        console.log(err.messages)
    })
}
