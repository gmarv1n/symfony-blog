<?php

namespace App\SQLFunctions;
 
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
 
/**
 * Usage: UUID_TO_BIN(uuid_string)
 *
 * @author Gregory Yatsukhno <gmarv9n@gmail.com>
 * @version 2020.04.20
 */

class UuidToBinFunction extends FunctionNode
{
    private $uuidString;
 
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
 
        $this->uuidString = $parser->StringExpression();
        
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
 
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return sprintf('UUID_TO_BIN(%s)',
            $sqlWalker->walkStringPrimary($this->uuidString));
    }
}
