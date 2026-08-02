<?php

declare(strict_types=1);

/**
 * Support tickets, news & knowledgebase.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Support tickets, news & knowledgebase — 13 operations.
 */
class Support extends Resource
{
    /**
     * Close ticket
     *
     * PUT /tickets/{number}/close — Bearer token required, from the API specification.
     *
     * Send request to close a ticket
     *
     * Body fields:
     *   - number (integer): Ticket number
     *
     * @param string|int $number
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function closeTicket($number, array $body = [], array $query = [])
    {
        $path = $this->path('/tickets/{number}/close', ['number' => $number]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Create Ticket
     *
     * POST /tickets — Bearer token required, from the API specification.
     *
     * Submit new ticket
     *
     * Body fields:
     *   - dept_id (integer): Department id
     *   - subject (string): Ticket subject
     *   - body (string): Ticket message
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createTicket(array $body = [], array $query = [])
    {
        return $this->call('POST', '/tickets', ['query' => $query, 'body' => $body]);
    }

    /**
     * Ticket attachment
     *
     * GET /ticket/attachment/{file} — Bearer token required, verified against the live API.
     *
     * Get ticket attachment
     *
     * Path parameters:
     *   - file: Attachment id
     *
     * Query parameters:
     *   - number: Ticket number
     *
     * @param string|int $file Attachment id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getAttachment($file, array $query = [])
    {
        $path = $this->path('/ticket/attachment/{file}', ['file' => $file]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get knowledgebase article
     *
     * GET /knowledgebase/article/{article_id} — Bearer token required, verified against the live API.
     *
     * Returns an article details
     *
     * @param string|int $articleId
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getKbArticle($articleId, array $query = [])
    {
        $path = $this->path('/knowledgebase/article/{article_id}', ['article_id' => $articleId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get knowledgebase category details
     *
     * GET /knowledgebase/{category_id} — Bearer token required, verified against the live API.
     *
     * Returns subcategories and articles of the knowledgebase category
     *
     * @param string|int $categoryId
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getKbCategory($categoryId, array $query = [])
    {
        $path = $this->path('/knowledgebase/{category_id}', ['category_id' => $categoryId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get news item
     *
     * GET /news/{news_id} — Bearer token required, from the API specification.
     *
     * Returns details of the news item
     *
     * @param string|int $newsId
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getNews($newsId, array $query = [])
    {
        $path = $this->path('/news/{news_id}', ['news_id' => $newsId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Ticket details
     *
     * GET /tickets/{number} — Bearer token required, verified against the live API.
     *
     * Get ticket details, including all replies
     *
     * Path parameters:
     *   - number: Ticket number
     *
     * @param string|int $number Ticket number
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getTicket($number, array $query = [])
    {
        $path = $this->path('/tickets/{number}', ['number' => $number]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List ticket departments
     *
     * GET /ticket/departments — Bearer token required, verified against the live API.
     *
     * Get the list of ticket departments
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listDepartments(array $query = [])
    {
        return $this->call('GET', '/ticket/departments', ['query' => $query]);
    }

    /**
     * List all knowledgebase categories
     *
     * GET /knowledgebase — Bearer token required, verified against the live API.
     *
     * Returns list all knowledgebase categories
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listKbCategories(array $query = [])
    {
        return $this->call('GET', '/knowledgebase', ['query' => $query]);
    }

    /**
     * List News
     *
     * GET /news — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listNews(array $query = [])
    {
        return $this->call('GET', '/news', ['query' => $query]);
    }

    /**
     * List Tickets
     *
     * GET /tickets — Bearer token required, verified against the live API.
     *
     * List support tickets under my account
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listTickets(array $query = [])
    {
        return $this->call('GET', '/tickets', ['query' => $query]);
    }

    /**
     * Re-open ticket
     *
     * PUT /tickets/{number}/open — Bearer token required, from the API specification.
     *
     * Try to re-open closed ticket
     *
     * Body fields:
     *   - number (integer): Ticket number
     *
     * @param string|int $number
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function reopenTicket($number, array $body = [], array $query = [])
    {
        $path = $this->path('/tickets/{number}/open', ['number' => $number]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Create Reply
     *
     * POST /tickets/{number} — Bearer token required, from the API specification.
     *
     * Reply to ticket
     *
     * Body fields:
     *   - number (integer): Ticket number
     *   - body (string): Reply message
     *
     * @param string|int $number
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function replyTicket($number, array $body = [], array $query = [])
    {
        $path = $this->path('/tickets/{number}', ['number' => $number]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

}
