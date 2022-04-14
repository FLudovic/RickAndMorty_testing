import React from "react";
import useCart from "../hooks/useCart";

const Cart = ({ setRoute }: { setRoute: (data: any) => void }) => {
  const { loading, products, message, loadCart, removeToCart } = useCart();
  return (
    <div>
      {loading && <div>Loading....</div>}
      {message && <p>{message}</p>}
      <div id="return" onClick={() => setRoute({ route: "home" })}>Retour</div>
      <div>
        {products.map((product, index) => {
          return (
            <React.Fragment>
              <div>
                <img src={product.image} alt="" />
                <p id={"productIndex-" + index }>Figurine de {product.name}</p>
                <p>Quantitée {product.quantity}</p>
              </div>
              <button id={"remove-" + index} onClick={() => removeToCart(product)}>
                Supprimer du panier
              </button>
              <hr />
            </React.Fragment>
          );
        })}
      </div>
    </div>
  );
};

export default Cart;
