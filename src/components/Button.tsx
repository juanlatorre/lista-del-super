"use client";

import styled, { css } from "styled-components";

interface Props {
  noLeftBorder?: boolean;
}

const Button = styled.button<Props>`
  height: 2em;
  margin: 0px;
  width: 2em;
  background-color: var(--dark);
  border-width: 1px;
  border-color: var(--dark);
  color: white;
  border: none;
  font-size: 18px;
  padding: 5px;
  align-self: stretch;

  ${(props) =>
    props.noLeftBorder
      ? css`
          border-radius: 0px 10px 10px 0px;
        `
      : css`
          border-radius: 10px;
        `}
`;

export default Button;
