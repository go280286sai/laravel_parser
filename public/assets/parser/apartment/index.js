class ApartmentList {

    pattern_title = /<h6 class=\"css-16v5mdi er34gjf0\">(.*?)<\/h6>/ig;
    pattern_title_item = /<h6 class=\"css-16v5mdi er34gjf0\">(.*?)<\/h6>/i;
    pattern_price = /<p data-testid=\"ad-price\" class=\"css-10b0gli er34gjf0\">(.*?)<\/p>/ig;
    pattern_price_item = /<p data-testid=\"ad-price\" class=\"css-10b0gli er34gjf0\">(.*?)<\/p>/i;
    pattern_reference = /\"css-rc5s2u\" href=\"(.*?)\"/ig
    pattern_reference_item = /\"css-rc5s2u\" href=\"(.*?)\"/i
    pattern_time_location = /\"css-veheph er34gjf0\">(.*?)<\/p>/ig
    pattern_time_location_item = /\"css-veheph er34gjf0\">(.*?)<\/p>/i
    title = [];
    price = [];
    url = []
    time = []
    location = []
    main = []

    constructor(text) {
 this.getText(text)
        // for(let i=1;i<25;i++){
        //     if (i===1){
        //         this.getText(text)
        //     }else {
        //         this.getText(`${text}?page=${i}`)
        //     }
        // }
    }

    async getText(text) {
        await axios.get(text)
           .then(
                async data => {
                    if (data.status!==200){
                        throw new Error('not page');
                    }
            let title = data.request.responseText.match(this.pattern_title);
            await this.getTitle(title)
            let price = data.request.responseText.match(this.pattern_price);
            await this.getPrice(price)
            let url = data.request.responseText.match(this.pattern_reference);
            await this.getReference(url)
            let time_location = data.request.responseText.match(this.pattern_time_location);
            await this.getTime_location(time_location)
            await this.getObject()
        }).catch(err=>{
                console.log(err)
            })
    }

    getTitle(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_title_item)[1];
            this.title.push(obj);
        }
    }

    getPrice(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_price_item)[1];
            let get_number = '';
            for (let i = 0; i < obj.length; i++) {
                if (obj[i] === '.') {
                    break;
                }
                if (isFinite(obj[i]) && obj[i] !== ' ') {
                    get_number += obj[i]
                }
            }
            if (get_number.length > 0) {
                this.price.push(get_number);
            }
        }
    }

    getReference(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_reference_item)[1];
            this.url.push('https://www.olx.ua' + obj);
        }
    }

    getTime_location(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_time_location_item)[1];
            obj = obj.split('<!-- --> - <!-- -->')
            this.location.push(obj[0]);
            this.time.push(obj[1]);

        }
    }

    getObject() {
        for (let i = 0; i < this.title.length; i++) {
            this.main.push([this.title[i], this.price[i], this.url[i], this.location[i], this.time[i]])
        }
    }

}


