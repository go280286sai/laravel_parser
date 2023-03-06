import axios from "axios";

export class Olx {

    pattern_title = /<h6 class=\"css-16v5mdi er34gjf0\">(.*?)<\/h6>/ig;
    pattern_title_item = /<h6 class=\"css-16v5mdi er34gjf0\">(.*?)<\/h6>/i;
    pattern_price = /<p data-testid=\"ad-price\" class=\"css-10b0gli er34gjf0\">(.*?)<\/p>/ig;
    pattern_price_item = /<p data-testid=\"ad-price\" class=\"css-10b0gli er34gjf0\">(.*?)<\/p>/i;
    title = [];
    price = [];

    /**
     * @return void
     * @param text
     */
     async getTitle(text) {
        await axios(text).then(data => {
            let title = data.request.responseText.match(this.pattern_title);
            for (let item of title) {
                let obj = item.match(this.pattern_title_item)[1];
                this.title.push(obj);
            }
            let price = data.request.responseText.match(this.pattern_price);
            for (let item of price) {
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
        })
    };
}


