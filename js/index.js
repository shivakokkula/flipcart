cart='';
function carty(brand,name,price,net)
{
    cart=(cart!='')?(cart+','+brand+' '+name+' '+price+' '+net):(brand+' '+name+' '+price+' '+net);
    localStorage.setItem("cart",cart);
    cart=localStorage.getItem("cart");
    alert(cart);
}