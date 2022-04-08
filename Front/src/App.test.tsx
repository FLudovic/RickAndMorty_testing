import React from 'react';
import ReactDOM from 'react-dom';
import { render, screen } from '@testing-library/react';
import { act } from 'react-dom/test-utils';

import App from './App';
import Product from './components/Product';
import Cart from './components/Cart';

let container: ReactDOM.Container | null;

beforeEach(() => {
  // Get before load the div
  container = document.createElement("div");
  document.body.appendChild(container);
});

test('Render home links', () => {
  render(<App />);
  const linkElement = screen.getByText(/Aller sur panier/i);
  expect(linkElement).toBeInTheDocument();
});

test('Render product links', () => {
  // Call product with product params
  act(() => {
    ReactDOM.render(
      <Product setRoute={() => {}} data= {{
        id:5,
        name:"Jerry Smith",
        price:"8",
        quantity:30,
        image:"https://rickandmortyapi.com/api/character/avatar/5.jpeg"                 
      }}
      />,
      container
    )
  });
  // Controls if return link exists (based on Product view id)
  const linkElementReturn = container?.querySelector("#return");
  expect(linkElementReturn?.textContent).toBe("Retour");

  const linkElementAdd = container?.querySelector("#add");
  expect(linkElementAdd?.textContent).toBe("Ajouter au panier");
});

test('Render cart links', () => {
  act(() => {
    ReactDOM.render(<Cart setRoute={() => {}} />, container);
  })
  const linkElement = container?.querySelector("#return");
  expect(linkElement?.textContent).toBe("Retour");
});