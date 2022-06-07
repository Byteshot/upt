class Tablero {

    constructor() {
        this.obtenerNombre(1);
        this.obtenerNombre(2);        
    }

    /**
     * @param {int} numero
     * @return {Boolean}
     * @description Obtener nombre Jugador
     */
    obtenerNombre(nJugador){
        let respuesta = false;
        while(respuesta == false){
            let nombre = prompt("Ingrese nombre Jugador" + nJugador);
            console.log(nombre);
            if(nombre == undefined || nombre == ""){
                respuesta = false;
            }else{
                this.jugador1 = new Jugador(nombre);                
                respuesta = true;
            }            
        }          
        // if(nombre == undefined || nombre == ""){
        //     nombre = "Player" + nJugador;
        // }
        // this.jugador1 = new Jugador(nombre);                             
    }
}