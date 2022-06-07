class Jugador {

    constructor (nombre){
        this.nombre = nombre;
        this.barcos = [];
        this.puntaje = 0;
        this.estatus = false;
        this.nBarcos = 0;   
    }

    /**
     * @param {String} nombreBarco 
     * @param {String} PosicionBarco 
     * @return {Boolean}
     */
    agregarBarco(nombreBarco, PosicionBarco){

        if(nombreBarco == undefined || PosicionBarco == undefined || nombreBarco == "" || PosicionBarco == ""){
            return false;
        }

        let barco = new Barco(nombreBarco, PosicionBarco);
        this.barcos.push(barco);
        this.nBarcos++;
        return true;
    }

    /**
     * @param {int} posicion
     * @return {Boolean}
     * @description Elimina un barco del array de barcos
     * */
    verificarTiro(PosicionTiro){
        
        if(PosicionTiro == undefined || PosicionTiro == ""){
            return false;
        }            
        
        for(let i = 0; i < this.barcos.length; i++){
            if(this.barcos[i] != "X"){                       
                if(PosicionTiro == this.barcos[i].posicion){
                    this.nBarcos--;
                    this.barcos.splice(i, 1, 'X');
                    this.puntaje++;
                    return true;
                }
            }
        }

        return false;

    }

}