export default class Gate{

    constructor(user){
        this.user = user;               
    }

    isRoot () {
        return this.user.is_root == 1;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'user';
    }
    
    isAdminOrUser(){
        if(this.user.type === 'user' || this.user.type === 'admin'){
            return true;
        }
    }
}

