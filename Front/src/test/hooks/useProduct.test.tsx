import {rest} from "msw";
import {setupServer} from "msw/node";
import { renderHook, act } from '@testing-library/react-hooks'
import useProduct from "../../hooks/useProduct";

jest.setTimeout(800000);

const server = setupServer(
    rest.get(
        "http://localhost:8000/api/cart/5",
        (req, res, ctx) => {
            return res(
                ctx.json({ id: 1 })
        )}
    ),
    // remove
);

beforeAll(() => server.listen());
afterEach(() => server.resetHandlers());
afterAll(() => server.close());

    test("load product", async () => {
        const { result } = renderHook(() =>
        useProduct({
            "id":5,
            "name":"Jerry Smith",
            "price":"8",
            "quantity":30,
            "image":"https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        })
        );
        const { loading, addProduct } = result.current;
        expect(loading).toEqual(false);
        await act(async () => {
            await addProduct();
        }); 
        const { message } = result.current;
    });