import Vue from 'vue';
import VueResource from 'vue-resource';
Vue.use(VueResource);
//exports.apiUser = Vue.resource('http://localhost:8080/r2/mockup/user/user.php');
const URL_SERVER = 'http://localhost:8080/r2/mockup/user';



/**
 * Mocking client-server processing
 */
const _operadores = [
    {"id": 1, "title": "iPad 4 Mini", "price": 500.01, "inventory": 2},
    {"id": 2, "title": "H&M T-Shirt White", "price": 10.99, "inventory": 10},
    {"id": 3, "title": "Charli XCX - Sucker CD", "price": 19.99, "inventory": 5}
]

const   user = {
    token: `jhlkjhlkjh-t4r5t4ert-4ery45`,
    id: 1,
    name: 'Rener'
};
const   users = {
    login: 'renerdias@msn.com',
    senha: 'lara'
};
export default {
    getUser(username, password) {
        var xhr = new XMLHttpRequest();
        var url = URL_SERVER + '/get.php?login=' + username + '&senha=' + password;
        //False = synchronous
        xhr.open("GET", url, false);
        xhr.send();
        if (xhr.readyState == 4 && xhr.status == 200) {
            return JSON.parse(xhr.responseText);
        }
    },
    checkUser() {
        return users;
    }
}
