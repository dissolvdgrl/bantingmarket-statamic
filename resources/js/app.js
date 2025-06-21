import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

let myApp = () => {
    return {
        addProductField() {
            console.log('gotcha');
        }
    }
}
