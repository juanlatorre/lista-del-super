"use client";

import styled, { css } from "styled-components";

interface Props {
  noRightBorder?: boolean;
}

const Input = styled.input<Props>`
  height: 2em;
  font-size: 18px;
  padding: 5px;
  border-width: 1px;
  border-color: var(--dark);
  align-self: stretch;

  ${(props) =>
    props.noRightBorder
      ? css`
          border-radius: 10px 0px 0px 10px;
        `
      : css`
          border-radius: 10px;
        `}

  ${(props) => props.noRightBorder && css``}
`;

export default Input;
