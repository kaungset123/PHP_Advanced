
       function addToCart(num){
            var ary=JSON.parse(localStorage.getItem("items")); // getting clicked each item
            if(ary == null ){
                // when there is no item before // get num(id) and store at localStorage by changing to json ary
                var itemAry = [num];
                localStorage.setItem("items",JSON.stringify(itemAry));
            }else{
                // when there is any item before // add another item 
                $con=ary.indexOf(num); // when you click one item twice
                if($con == -1){ // when you don't click one item twice
                    ary.push(num);
                    localStorage.setItem("items",JSON.stringify(ary));// storing both old and new into ary
                }               
            }
            // getCartItem();
            alert("An item added to cart");
            showCartItem();
        }

        function showCartItem(){
            let ary = JSON.parse(localStorage.getItem("items"));
            if(ary != null){
                $("#cart_count").html(ary.length); 
            }else{
                $("#cart_count").html(0); 
            }
            
        }

        function getCartItem(){
            let ary = JSON.parse(localStorage.getItem("items"));
            // console.log(ary);
            return ary; 
        }

        function deleteItem(id){
            var ary = JSON.parse(localStorage.getItem("items"));
            if(ary != null){
                ary.forEach((item) => {
                    if(item == id) {
                        var ind = ary.indexOf(item);
                        ary.splice(ind,1);
                    }
                })
            }
            localStorage.setItem("items",JSON.stringify(ary));
            showCartItem();
        }

        function clearCart(){
            localStorage.removeItem("items");
        }
        showCartItem();
