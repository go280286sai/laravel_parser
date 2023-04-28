class ApartmentView {

    pattern_title = /<h6 class=\"css-16v5mdi er34gjf0\">(.*?)<\/h6>/ig;
    pattern_title_item = /<h6 class=\"css-16v5mdi er34gjf0\">(.*?)<\/h6>/i;
    pattern_price = /<p data-testid=\"ad-price\" class=\"css-10b0gli er34gjf0\">(.*?)<\/p>/ig;
    pattern_price_item = /<p data-testid=\"ad-price\" class=\"css-10b0gli er34gjf0\">(.*?)<\/p>/i;
    pattern_reference = /\"css-rc5s2u\" href=\"(.*?)\"/ig
    pattern_reference_item = /\"css-rc5s2u\" href=\"(.*?)\"/i
    pattern_time_location = /\"css-veheph er34gjf0\">(.*?)<\/p>/ig
    pattern_time_location_item = /\"css-veheph er34gjf0\">(.*?)<\/p>/i
    pattern_floor = /\"css-b5m1rv er34gjf0\">Поверх:(.*?)<\/p>/ig
    pattern_floor_item = /\"css-b5m1rv er34gjf0\">Поверх:(.*?)<\/p>/i
    pattern_room = /\"css-b5m1rv er34gjf0\">Кількість кімнат:(.*?)<\/p>/ig
    pattern_room_item = /\"css-b5m1rv er34gjf0\">Кількість кімнат:(.*?)<\/p>/i
    pattern_area = /\"css-b5m1rv er34gjf0\">Загальна площа:(.*?)<\/p>/ig
    pattern_area_item = /\"css-b5m1rv er34gjf0\">Загальна площа:(.*?)<\/p>/i
    pattern_type = /\"css-b5m1rv er34gjf0\"><span>(.*?)<\/span><\/p>/ig
    pattern_type_item = /\"css-b5m1rv er34gjf0\"><span>(.*?)<\/span><\/p>/i
    pattern_etajnost = /\"css-b5m1rv er34gjf0\">Поверховість:(.*?)<\/p>/ig
    pattern_etajnost_item = /\"css-b5m1rv er34gjf0\">Поверховість:(.*?)<\/p>/i
    pattern_description = /<div\s+class="css-bgzo2k\s+er34gjf0">([\s\S]*?)<\/div>/i;
    pattern_description_item = /\"css-bgzo2k er34gjf0\">(.*?)<\/div>/i
    title = [];
    price = [];
    url = []
    time = []
    location = []
    floor = []
    etajnost = []
    rooms = []
    type = []
    description = []
    main = []
    area = []

    constructor(text) {
        this.getText(text)
    }

    async getText(text) {
        await axios.get(text)
            .then(
                async data => {
                    let title = data.request.responseText.match(this.pattern_title);
                    await this.getTitle(title)
                    let price = data.request.responseText.match(this.pattern_price);
                    await this.getPrice(price)
                    let url = data.request.responseText.match(this.pattern_reference);
                    await this.getReference(url)
                    let time_location = data.request.responseText.match(this.pattern_time_location);
                    await this.getTime_location(time_location)
                }).catch(err => {
                console.log(err.message)
            })
    }

    async getFullText(text) {
        await axios.get(text)
            .then(
                async data => {
                    let floor = data.request.responseText.match(this.pattern_floor);
                    await this.getFloor(floor)
                    let room = data.request.responseText.match(this.pattern_room);
                    await this.getRoom(room)
                    let type = data.request.responseText.match(this.pattern_type);
                    await this.getType(type)
                    let etajnost = data.request.responseText.match(this.pattern_etajnost);
                    await this.getEtajnost(etajnost)
                    let area = data.request.responseText.match(this.pattern_area);
                    await this.getArea(area)
                    let description = data.request.responseText.match(this.pattern_description);
                    this.description.push(description[1])
                }).catch(err => {
                console.log(err.message)
            })
    }

    getTitle(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_title_item)[1];
            this.title.push(obj);
        }
    }

    getFloor(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_floor_item)[1];
            this.floor.push(parseInt(obj));
        }
    }

    getRoom(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_room_item)[1];
            this.rooms.push(parseInt(obj));
        }
    }

    getEtajnost(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_etajnost_item)[1];
            this.etajnost.push(parseInt(obj));
        }
    }
    getArea(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_area_item)[1];
            this.area.push(parseInt(obj));
        }
    }

    getType(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_type_item)[1];
            this.type.push(obj);
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

    async getReference(text) {
        for (let item of text) {
            let obj = item.match(this.pattern_reference_item)[1];
            let address = 'https://www.olx.ua' + obj;
            this.url.push(address);
            await this.getFullText(address)
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
}
