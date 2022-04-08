import React from 'react';
import { render, screen } from '@testing-library/react';
import App from './App';

test('Render home', () => {
  render(<App />);
  const linkElement = screen.getByText(/Aller sur panier/i);
  expect(linkElement).toBeInTheDocument();
});