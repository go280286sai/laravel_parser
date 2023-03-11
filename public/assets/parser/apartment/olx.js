let GET_URL = $('#url_olx').val();
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
            get_url_olx: GET_URL,
            i: 0,
            get_url_status: true,
            check_items:[]
        }
    },
    methods: {
        send_check(){
            axios.post('/user/checks_remove', {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'checks':this.check_items
            }).then(() => {
                location.reload()
            }).catch((err) => {
                console.log(err.message)
            })
        },
        getRecursia() {
            // while (this.get_url_status){
            //     axios.get(GET_URL).then(data=>{
            //         if(data.status !== 200){
            //             this.get_url_status = false;
            //            throw new Error('This url is false')
            //         }else {
            //                 getApartment(GET_URL);
            //                 GET_URL=`${GET_URL}?page=${this.i++}`
            //         }
            //     }).catch(err=>{
            //         console.log('the end')
            //     })
            //
            // }
            this.getApartment(GET_URL)
        },
        getApartment(text) {
            const obj = new ApartmentView(text)
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
                            'title': this.obj_title[i],
                            'url': this.obj_url[i],
                            'rooms': this.obj_rooms[i],
                            'floor': this.obj_floor[i],
                            'etajnost': this.obj_etajnost[i],
                            'price': this.obj_price[i],
                            'type': this.obj_type[i],
                            'description': this.obj_description[i],
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
            axios.post('/user/saveJson', {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }).then(data => {
                console.log(data.statusText)
            }).catch(err => {
                console.log(err.message)
            })
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
            axios.post('/user/cleanDb', {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }).then(() => {
                location.reload()
            }).catch((err) => {
                console.log(err.message)
            })
        }
    }
}).mount('#apartment')
