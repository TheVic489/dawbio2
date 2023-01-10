/**
   * @file Manages the account class
   * @version 1.1
   * @author Alumne DAW Bio2
*/

/**
   * @class account with all data
   * 
 */
class AccountType{
    countructor(dni, type){
        this.dni = dni;
        this.type = type;
    }

    // Getters
    get dni(){
        return this.dni;
    }

    get type(){
        return this.type;
    }
}


/**
   * @class account with all data
   * 
 */
class Account{

    // Constructor
    constructor(DNIClient, fullName, AccountType, amount, clientType, entryDate){
        this.dni = DNIClient;
        this.fullName = fullName;
        this.AccountType = AccountType;
        this.amount = amount;
        this.clientType = clientType;
        this.entryDate = entryDate;
    }
    // Methods  
    entryDate(){
        return this.datepicker();
    }

}
