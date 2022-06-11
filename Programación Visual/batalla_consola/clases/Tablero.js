class Tablero {

    
    constructor() {
        this.jugador1 = this.obtenerNombre(1);
        this.jugador2 = this.obtenerNombre(2);
        this.nBarcos = 5; // -- Cantidad de barcos por jugador
        //this.crearTablero(this.jugador1);
        this.agregarBarcoTablero(this.jugador1);
    }

    /**
     * @param {int} numero
     * @return {Boolean}
     * @description Obtener nombre Jugador
     */
    obtenerNombre(nJugador){

        let respuesta = false;
        let nombre = "";

        while(respuesta == false){

            nombre = prompt("Ingrese nombre Jugador" + nJugador);            

            if(nombre == undefined || nombre == ""){
                respuesta = false;
            }else{                
                respuesta = true;
            }                                  
        }          
        return new Jugador(nombre);
        // if(nombre == undefined || nombre == ""){
        //     nombre = "Player" + nJugador;
        // }
        // this.jugador1 = new Jugador(nombre);                             
    }    

    /**
     * @param {int} tamanio
     * @description Crear tablero de juego
     */
     crearTablero(tamanio = 0){
        
        while (tamanio <= this.nBarcos){
            tamanio = prompt("El tablero debe ser mayor a " + this.nBarcos + " barcos");
        }        
        this.tamanio = tamanio;

        this.tableroJugador1 = this.llenarTableroVacio();
        this.tableroJugador2 = this.llenarTableroVacio();

     }

     /**
     * @param {int} tamanio
     * @description Crear tablero de juego
     */ 
    llenarTableroVacio(){        

        let tableroVacio = new Array();

        for(let i = 0; i < this.tamanio; i++){
            tableroVacio[i] = 'O';
        }
        return tableroVacio;
    }

    /**
     * @param {int} posicion
     * @param {string} nombre
     * @description Posición para agregar barco
     */ 
     agregarBarcoTablero(jugador){        
        
        for(let i = 1; i <= this.nBarcos; i++){

            let posicion = prompt("Ingrese posicion para agregar barco"+ i);                        
            let verificacion = true;

            do{            
                verificacion = true;    
                for(let j = 0; j < jugador.barcos.length; j++){                    
                    if(posicion == jugador.barcos[j].posicion){
                        posicion = prompt("Posicion ya ocupada, ingrese otra posicion");
                        verificacion = false;   
                        break;                     
                    }
                }            
            }while(verificacion == false);

        }

    }

}