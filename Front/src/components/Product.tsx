import useProduct from "../hooks/useProduct";

const Product = ({ setRoute, data: product }: any) => {
  const { quantity, message, loading, setQuantity, addProduct } =
    useProduct(product);

  return (
    <div>
      {loading && <div>Loading....</div>}
      {message && <p id="saveSuccess">{message}</p>}
      <div id="return" onClick={() => setRoute({ route: "home" })}>Retour</div>
      <div>
        <div>
          <img src={product.image} alt="" />
          <p>Figurine de {product.name}</p>
          <p id="productQuantity">Quantitée {product.quantity}</p>
        </div>
      </div>
      <hr />
      <input
        type="number"
        value={quantity}
        onChange={(e) => setQuantity(Number(e.target.value))}
        placeholder="Quantité à ajouter"
      />
      <button id="add" onClick={addProduct}>Ajouter au panier</button>
    </div>
  );
};

export default Product;
