<?php

namespace Nats;

/**
 * Message Class.
 *
 * @package Nats
 */
class Message
{

    /**
     * Message Body.
     *
     * @var string
     */
    public $body;
    /**
     * Message Subject.
     *
     * @var string
     */
    private $subject;
    /**
     * Message Ssid.
     *
     * @var string
     */
    private $sid;

    /**
     * Message related connection.
     *
     * @var Connection
     */
    private $conn;


    /**
     * Message constructor.
     *
     * @param string     $subject Message subject.
     * @param string     $body Message body.
     * @param string     $sid Message Sid.
     * @param Connection $conn Message Connection.
     */
    public function __construct ($subject, $body, $sid, Connection $conn)
    {
        $this->setSubject($subject);
        $this->setBody($body);
        $this->setSid($sid);
        $this->setConn($conn);
    }

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject ()
    {
        return $this->subject;
    }

    /**
     * Set subject.
     *
     * @param string $subject Subject.
     *
     * @return $this
     */
    public function setSubject ($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get Ssid.
     *
     * @return string
     */
    public function getSid ()
    {
        return $this->sid;
    }

    /**
     * Set Ssid.
     *
     * @param string $sid Ssid.
     *
     * @return $this
     */
    public function setSid ($sid)
    {
        $this->sid = $sid;
        return $this;
    }

    /**
     * String representation of a message.
     *
     * @return string
     */
    public function __toString ()
    {
        return $this->getBody();
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody ()
    {
        return $this->body;
    }

    /**
     * Set body.
     *
     * @param string $body Body.
     *
     * @return $this
     */
    public function setBody ($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get Conn.
     *
     * @return Connection
     */
    public function getConn ()
    {
        return $this->conn;
    }

    /**
     * Set Conn.
     *
     * @param Connection $conn Connection.
     *
     * @return $this
     */
    public function setConn (Connection $conn)
    {
        $this->conn = $conn;
        return $this;
    }

    /**
     * Allows you reply the message with a specific body.
     *
     * @param $body
     *
     * @throws Exception
     */
    public function reply ($body)
    {
        $this->conn->publish(
            $this->subject,
            $body
        );
    }
}
