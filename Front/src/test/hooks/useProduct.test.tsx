import { rest } from "msw";
import { setupServer } from "msw/node";
import { renderHook, act } from "@testing-library/react-hooks";
import useProduct from "../../hooks/useProduct";

const server = setupServer(
  rest.post("http://localhost:8000/api/cart/2", (req, res, ctx) => {
    return res(
      ctx.json({"error":"too many"})
    );
  })
);

beforeAll(() => server.listen());
afterEach(() => server.resetHandlers());
afterAll(() => server.close());

test("Load product", async () => {
  const { result } = renderHook(() =>
    useProduct({
      id: 2,
      name: "Rick Sanchez",
      price: "9,99",
      quantity: 0,
      image: "https://rickandmortyapi.com/api/character/avatar/1.jpeg",
    })
  );
  const { loading, addProduct } = result.current;
  expect(loading).toEqual(false);
  await act(async () => {
    await addProduct();
  }); 
  const { message } = result.current;
//   console.log(message);
});