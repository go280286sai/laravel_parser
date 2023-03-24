import {ApartmentView} from "./view";
import axios from "axios";

let GET_URL = $('#url_olx').val();
function getStatus(text)
{
    console.log(text)
    setTimeout(() => {
        axios.post('/user/set_status', {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'id': text
        }).then(() => {
            console.log('status ok')
        }).catch((err) => {
            console.log(err.message);
        })
    }, 300000)
}

function getNewPrice(text){
    console.log(text)
    // axios.post('http://localhost:8000/olx_apartment',text).then((data) => {
    //     console.log(data)
    // }).catch((err) => {
    //     console.log(err.message);
    // })
}
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
            obj_area:[],
            status: false,
            get_url_olx: GET_URL,
            get_url_status: true,
            check_items: [],
            update_status: false,
            json_data:[]
        }
    },
    methods: {
        send_check() {
            axios.post('/user/checks_remove', {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'checks': this.check_items
            }).then(() => {
                location.reload()
            }).catch((err) => {
                console.log(err.message)
            })
        },
        sendPushMessage($text) {
            axios.post('/user/sendPushMessage', {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'text': $text
            }).then(data => {
                console.log(data.status)
            }).catch(err => {
                console.log(err.message)
            })
        },
        getApartment() {
            const obj = new ApartmentView(GET_URL)
            this.update_status = true;
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
                this.obj_area=obj.area
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
                            'date': this.obj_time[i],
                            'area':this.obj_area[i],
                        }).catch(err => {
                            console.log(err.message)
                        })
                    }
                }, 5000)
                setTimeout(() => {
                    this.sendPushMessage('Данные обновлены');
                    this.update_status = false;
                }, 20000)
            }, 35000);
        },
        getStatus(text) {
            console.log(text)
            setTimeout(() => {
                axios.post('/user/set_status', {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'id': text
                }).then(() => {
                    console.log('status ok')
                }).catch((err) => {
                    console.log(err.message);
                })
            }, 300000)
        },
        saveList() {
            axios.post('/user/saveJson', {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }).then(() => {
                location.reload()
            }).catch((err) => {
                console.log(err.message)
            })
        },
        getNewPrice(text){
            console.log(text)
            axios.post('http://localhost:8000/olx_apartment',text).then((data) => {
                axios.post('/user/setNewPrice', {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'price':data
                }).then((data)=>{
                    console.log(data.status)
                }).catch(err=>{
                    console.log(err.message)
                })
                console.log(data)
            }).catch((err) => {
                console.log(err.message);
            })
        }
    }
}).mount('#apartment')
