package roc_version

import (
	"github.com/hyperf/roc"
	"github.com/hyperf/roc/exception"
	"github.com/hyperf/roc/serializer"
)

type SayHello struct {
}

func (v *SayHello) Handle(packet *roc.Packet, serializer serializer.SerializerInterface) (any, exception.ExceptionInterface) {
	return "Hello ROC", nil
}
