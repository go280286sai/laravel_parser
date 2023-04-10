<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
<script src="{{env('APP_URL').'/assets/plugins/jQuery/jquery-2.2.3.min.js'}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // function getKurs(){
    //     axios.get('https://bank.gov.ua/').then((data)=>{
    //         console.log(data)
    //     }).catch(err=>{
    //         console.log(err.messages)
    //     })
    // }
    function getKurs(){
        $.ajax({
            url:'https://raiffeisen.ua/privatnim-osobam/rahunokk/cards-raif/raifkartka-plus?utm_source=google&utm_medium=cpc&utm_campaign=RBA_PI_Raif_Card_Search_Brand&gclid=EAIaIQobChMImNLIzOeI_gIVideyCh2AfQLXEAAYASAAEgKG0_D_BwE',
            method: 'GET',
            success: (data)=>{
                console.log()
            },
            error:(err)=>{
                console.log(err.message)
            },
            headers:{'User-Agent':'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/111.0',
            'Access-Control-Allow-Origin':'*'}
        })
    }
    getKurs()
</script>


