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
    countructor(id, type){
        this.id = id;
        this.type = type;
    }

    // Getters
    get id(){
        return this.id;
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
    constructor(DNIClient, fNameClient, AccountType, amount, clientType, entryDate){
        this.id = DNIClient;
        this.fullNameClient = fNameClient;
        this.AccountType = AccountType;
        this.amount = amount;
        this.clientType = clientType;
        this.entryDate = entryDate;
    }

    // Getters
    get DNIClient(){
        return this.DNIClient;
    }

    get fullNameClient(){
        return this.fullNameClient;
    }

    get AccountType(){
        return this.AccountType;
    }

    get amount(){
        return this.amount;
    }

    get entryDate(){
        return this.entryDate();
    }

    // Setters
    set DNIClient(DNIClient){
        this.DNIClient = DNIClient;
    }

    set AccountType(AccountType){
        this.AccountType = AccountType;
    }

    set amount(amount){
        this.amount = amount;
    }

    set entryDate(entryDate){
        this.entryDate = entryDate();
    }

    set fullNameClient(fNameClient){
        this.fullNameClient = fNameClient;
    }

    // Methods  
    entryDate(){
        return this.datepicker();
    }

}
