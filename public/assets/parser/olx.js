Vue.createApp({
    data() {
        return {
            main: [],
            get_url: '',
            csv: [],
            status_list: false,
            get_category: '1',
            obj_url: [],
            obj_title: [],
            obj_time: [],
            obj_description: [],
            obj_rooms: [],
            obj_etajnost: [],
            obj_floor: [],
            obj_location: [],
            obj_price: [],
            obj_type: [],
            status: false,
        }
    },
    methods: {
        getApartmentFull() {
            const URL_OLX = $('#url_olx').val()
            const obj = new ApartmentView(URL_OLX)
            setTimeout(() => {
                this.obj_title = obj.title
                this.obj_price = obj.price
                this.obj_location = obj.location
                this.obj_description = obj.description
                this.obj_etajnost = obj.etajnost
                this.obj_floor = obj.floor
                this.obj_rooms = obj.rooms
                this.obj_time = obj.time
                this.obj_url = obj.url
                this.obj_type = obj.type
                setTimeout(() => {
                    for (let i = 0; i < this.obj_title.length; i++) {
                        axios.post('/user/addOlxApartment', {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'id': 0,
                            'title': this.obj_title[i],
                            'url': this.obj_url[i],
                            'rooms': this.obj_rooms[i],
                            'floor': this.obj_floor[i],
                            'etajnost': this.obj_etajnost[i],
                            'price': this.obj_price[i],
                            'type': this.obj_type[i],
                            'views': 1,
                            'description': this.obj_description[i],
                            'comment': ' ',
                            'location': this.obj_location[i],
                            'date': '2000-02-02'
                        }).then(data => {
                            console.log(data)
                        }).catch(err => {
                            console.log(err.message)
                        })
                    }
                }, 5000)
            }, 35000);
        },
        saveList() {

        },
        updateInfo(title) {
            let form = $(`form#${title}`);
            axios.post(form.attr('action'), form.serialize()).then(() => {
                this.status = true;
                setTimeout(() => {
                    this.status = false;
                }, 5000);
            }).catch(() => {
                console.log('error')
            })
        },
        cleanDb() {
            let form = $(`form#cleanDb`);
            axios.post(form.attr('action'), form.serialize()).then(() => {
                this.status = true;
                setTimeout(() => {
                    this.status = false;
                }, 5000);
            }).catch(() => {
                console.log('error')
            })
        }
    }
}).mount('#apartment')
